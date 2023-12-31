import { mapOptions } from './mapConfig';
import { newSpotName, sleep, truncate } from './functions';
import { getOneFromData, getAll, getUserID, update, create, getOne } from './api.js';
let map;
import * as THREE from 'three';
import { MTLLoader } from 'three/examples/jsm/loaders/MTLLoader';
import { OBJLoader } from 'three/examples/jsm/loaders/OBJLoader';
let scene, camera, renderer, model;

async function initialize() {
const uid = await getUserID();
let footprint = await getOne('footprints', uid);
if (!footprint) {
    const newFootprintData = {
        id: uid,
        rights_write: 1,
        rights_read: 0
    };
    await create('footprints', newFootprintData);
    footprint = await getOne('footprints', uid);
}

// Initialize the scene, camera, and renderer.
scene = new THREE.Scene();
camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setSize(window.innerWidth, window.innerHeight);
document.getElementById('3d-model').appendChild(renderer.domElement);

// Position the camera.
camera.position.z = 9;
camera.position.y += 1;

// Load the 3D model.
let mtlLoader = new MTLLoader();
let objLoader = new OBJLoader();

mtlLoader.load('models/ducks/Duck.mtl', function (materials) {
    materials.preload();
    objLoader.setMaterials(materials);
    objLoader.load('models/ducks/Duck.obj', function (obj) {
        model = obj;
        model.scale.set(0.2, 0.2, 0.2); // 調整: モデルのサイズを設定
        const boundingBox = new THREE.Box3().setFromObject(model);
        const modelHeight = boundingBox.max.y - boundingBox.min.y;
        model.position.y = modelHeight / 2; // Set the model's position to half of its height.
        model.rotation.y = Math.PI;
        model.rotation.x += THREE.MathUtils.degToRad(25);
        const ambientLight = new THREE.AmbientLight(0xffffff, 1);
        scene.add(ambientLight);
        const ambientLight2 = new THREE.AmbientLight(0xfafad2, 1);
        scene.add(ambientLight2);
        scene.add(model);
    });
});

// Create the animation loop.
function animate() {
    requestAnimationFrame(animate);
    // Rotate the model.
    renderer.render(scene, camera);
}
animate();

async function initMap() {
  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");
  const { PlacesService, PlacesServiceStatus, RankBy } = await google.maps.importLibrary("places");
    let promises = [];
    let cardsData = [];
    // Use the browser's built-in Geolocation API to get the current location.
    navigator.geolocation.getCurrentPosition(async function (position) {
        let currentPosition = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
        };

        // Get the initial heading from the device orientation.
        let initialHeading = 0;
        if (window.DeviceOrientationEvent) {
        window.addEventListener("deviceorientation", function(event) {
            // Check if the browser provides alpha value (compass direction)
            if (event.alpha !== null) {
            // Alpha is the compass direction the device is facing in degrees.
            initialHeading = event.alpha;
            }
            // If alpha value is not provided, initialHeading remains 0.
        }, false);
        }

        map = new Map(document.getElementById("map"), mapOptions(currentPosition, initialHeading));
        // Set a pin on the current location.

        let markers = [];

        const imageDuckPinElement = document.createElement('img');
        imageDuckPinElement.src = 'img/duckpin.svg';
        imageDuckPinElement.style.width = '52px';
        imageDuckPinElement.style.height = '148px';

        const markerView = new AdvancedMarkerElement({
            map,
            content: imageDuckPinElement,
            position: currentPosition,
            zIndex: 999 // この値を他のマーカーよりも大きく設定
        });

        markers.push(markerView);

        // Create a circle centered at the current position.
        const circleRadius = 250;
        let circle = new google.maps.Circle({
            strokeColor: '#db8555',
            strokeOpacity: 0.8,
            strokeWeight: 3,
            fillColor: '#f8c967',
            fillOpacity: 0.15,
            map: map,
            center: currentPosition,
            radius: circleRadius,
        });
        // Directions and their corresponding degrees
        const directions = {
            '北': 90,
            '東': 180,
            '南': 270,
            '西': 0,
        };

        // Function to calculate point on circle for given center and radius
        function calculatePoint(center, angleInDegrees, radius) {
            const angleInRadians = (angleInDegrees - 90) * Math.PI / 180.0;
            const latRadius = radius / 111325; // divide by ~111325 to convert radius from meters to degrees
            const lngRadius = latRadius / Math.cos(center.lat * Math.PI / 180); // adjust for Earth's sphericity
            return {
            lat: center.lat + (latRadius * Math.cos(angleInRadians)),
            lng: center.lng + (lngRadius * Math.sin(angleInRadians)),
            };
        }

        // Loop over each direction and create a marker
        for (const [direction, degree] of Object.entries(directions)) {
            // Calculate point on circle for current direction
            const point = calculatePoint(currentPosition, degree, circleRadius);

            // Create SVG for the marker
            const directionSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" font-size="24" font-weight="bold" stroke="#f8c967" stroke-width="1" fill="#db8555" fill-opacity="0.8">${direction}</text></svg>`;

            // Create the marker for the direction
            const directionMarker = new google.maps.Marker({
                position: point,
                map,
                icon: {
                    url: 'data:image/svg+xml,' + encodeURIComponent(directionSvg),
                    scaledSize: new google.maps.Size(22, 22),
                },
            });
        }

        // Use the PlacesService to find nearby parks.
        const placesService = new PlacesService(map);
        const request = {
            location: currentPosition,
            // radius: '500', // No longer required when using RankBy.DISTANCE
            rankBy: RankBy.DISTANCE,
            type: ['park'], // Changed type to keyword
        };
        let placeIds = []; // To store unique placeIds
        // An object to store markers by placeId for easy access
        let markersByPlaceId = {};

        placesService.nearbySearch(request, (results, status) => {
            if (status === PlacesServiceStatus.OK) {
                for (let i = 0; i < results.length; i++) {
                    if (!results[i].types.some(type => request.type.includes(type))) {
                        continue;
                    }
                    if (placeIds.includes(results[i].place_id)) {
                        continue;
                    }
                    placeIds.push(results[i].place_id);

                    let isInCircle = google.maps.geometry.spherical.computeDistanceBetween(results[i].geometry.location, circle.getCenter()) <= circle.getRadius();
                    const imageElement = document.createElement('img');
                    imageElement.src = isInCircle ? 'img/kirabottle.png' : 'img/palebottole.png';
                    imageElement.style.width = '40px';
                    imageElement.style.height = '80px';

                    // Marker creation
                    const marker = new AdvancedMarkerElement({
                        map,
                        content: imageElement, // use imageElement here
                        position: results[i].geometry.location,
                    });

                    marker.placeId = results[i].place_id;
                    markers.push(marker);
                    markersByPlaceId[marker.placeId] = marker;  // Store the marker by its placeId

                    // Add a click listener to the marker to scroll to its corresponding card
                    marker.addListener('click', () => {
                        const card = document.querySelector(`.card[data-place-id="${marker.placeId}"]`);
                        const scrollContainer = document.querySelector('#cards-slider');

                        // Calculate where to scroll. This centers the card in the container.
                        const scrollPosition = card.offsetLeft - (scrollContainer.offsetWidth / 2) + (card.offsetWidth / 2);
                        scrollContainer.scrollTo({ left: scrollPosition, behavior: 'smooth' });
                    });

                    function getDirection(degrees) {
                        const directions = ['北', '北東', '東', '南東', '南', '南西', '西', '北西'];
                        const index = Math.round(((degrees %= 360) < 0 ? degrees + 360 : degrees) / 45) % 8;
                        return directions[index];
                    }

                    // Create an array to store the data.
                    let promise = new Promise((resolve, reject) => {
                        placesService.getDetails({ placeId: marker.placeId }, (place, status) => {
                            if (status === PlacesServiceStatus.OK) {
                                // Remove postal code and country from the address.
                                const addressParts = place.formatted_address.split(',');
                                const address = addressParts.slice(0, -2).join(',').trim();

                                // Calculate distance in meters and round down to the nearest whole number.
                                const distance = Math.floor(google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(currentPosition), place.geometry.location));

                                // Calculate direction and convert to 8-direction format.
                                const directionDegrees = google.maps.geometry.spherical.computeHeading(new google.maps.LatLng(currentPosition), place.geometry.location);
                                const direction = getDirection(directionDegrees);
                                cardsData.push({
                                    placeId: place.place_id,
                                    name: place.name,
                                    nickname: 'みかいたくのち',
                                    address: address,
                                    latitude: place.geometry.location.lat(),
                                    longitude: place.geometry.location.lng(),
                                    distance: distance + 'm',
                                    direction: direction,
                                    photoURL: place.photos ? place.photos[0].getUrl() : '/img/type-park.png',
                                    isInCircle: isInCircle,
                                });
                                resolve(); // Resolve the promise when the detail request is done.
                            } else {
                                reject(); // Reject the promise if there is an error.
                            }
                        });
                    });

                    // Add the promise to the promises array.
                    promises.push(promise);
                }
                // When all the promises are done, sort the data and generate the cards.
                Promise.all(promises).then(async () => {
                    cardsData.sort((a, b) => parseInt(a.distance) - parseInt(b.distance));
                    document.querySelector('#cards-slider').innerHTML = '';
                    const spotsData = await getAll('spots');  // Fetch all spots data once
                    const messagesData = await getAll('messages');  // Fetch all messages data once

                    for (const cardData of cardsData) {
                        const gmpid = cardData.placeId;

                        // Find the data from the fetched spots data
                        const data = spotsData.find(spot => spot.gmpid === gmpid);

                        const nickname = data?.name || 'みかいたくのち';
                        const spotId = data?.id;
                        let msgCount = 0;

                        // Check if data exists before fetching messages
                        if (data) {
                            // Find the messages for this spot from the fetched messages data
                            const res = messagesData.filter(message => message.spot_id === spotId);
                            msgCount = res ? res.filter(msgData => msgData.status === '投下済み' && msgData.writer_id !== uid).length : 0;
                        }

                        const newCardData = { ...cardData, nickname, msgCount };
                        generateCard(newCardData);
                        await sleep(100);
                    }

                    function generateCard(cardData) {
                        document.querySelector('#cards-slider').innerHTML += `<div style="background-color: ${cardData.isInCircle ? '#FFFFFF' : '#E5E7EB'}" class="card flex-none w-64 h-48 mr-4 mb-4 rounded-xl shadow-lg flex flex-col justify-between" data-place-id="${cardData.placeId}">
                                <img src="${cardData.photoURL}" class="w-full h-2/5 object-cover rounded-t-xl scale">
                                <div class="p-3 scale">
                                    <p class="text-xs text-gray-500">${truncate(cardData.name, 12)} - ${cardData.direction} ${cardData.distance}</p>
                                    <h2 class="text-base text-gray-700 font-semibold">${truncate(cardData.nickname, 12)}</h2>
                                    <p class="text-xs text-gray-400">${cardData.msgCount}件あります</p>
                                </div>
                                <button data-place-id="${cardData.placeId}" data-place-lat="${cardData.latitude}" data-place-lng="${cardData.longitude}" style="background-color: ${cardData.isInCircle ? '#1E2082' : '#6A7280'}" class="${cardData.isInCircle ? 'pickup-button' : 'not-pickup-button'} p-3 text-sm text-white rounded-b-xl" ${cardData.isInCircle ? '' : 'disabled'}>ここに秘密をなげる</button>
                            </div>`;
                    }
                    const scaleElements = document.querySelectorAll('.card .scale');
                    scaleElements.forEach(element => {
                        element.addEventListener('click', () => {
                            const marker = markersByPlaceId[element.closest('.card').dataset.placeId];
                            marker.content.style.transform = 'scale(1.5)';  // Increase size of icon
                        });
                    });
                    google.maps.event.addListener(map, 'click', () => {
                        for (let placeId in markersByPlaceId) {
                            markersByPlaceId[placeId].content.style.transform = 'scale(1.0)';  // Reset size of icon
                        }
                    });
                    const buttons = document.querySelectorAll('.pickup-button');
                    buttons.forEach(button => {
                        button.addEventListener('click', async (event) => {
                            const placeId = event.target.getAttribute('data-place-id');
                            const latitudeString = event.target.getAttribute('data-place-lat');
                            const longitudeString = event.target.getAttribute('data-place-lng');
                            const latitude = parseFloat(latitudeString).toFixed(6);
                            const longitude = parseFloat(longitudeString).toFixed(6);
                            const draft = await getOneFromData('messages', 'writer_id', uid);
                            if (draft.status == '下書き'){
                                let spot = await getOneFromData('spots', 'gmpid', placeId);
                                // スポットが存在しない場合、新しいスポットを作成する
                                if (!spot) {
                                    const newSpotData = {
                                        type: 'park',
                                        gmpid: placeId,
                                        name: newSpotName(),
                                        latitude: latitude,
                                        longitude: longitude,
                                    };
                                    spot = await create('spots', newSpotData);
                                }
                                let Data = {
                                    ...draft,
                                    status: '投下済み',
                                    spot_id: spot.id,
                                };
                                await update('messages', draft.id, Data);
                                let footprintData = {
                                    ...footprint,
                                    rights_read: 1,
                                };
                                await update('footprints', footprint.id, footprintData);
                                window.location.href = '/throwing';
                            } else {
                                // モーダルを表示する
                                const modal = document.getElementById('myModal');
                                modal.classList.remove('hidden');
                            }
                        });
                    });
                });
            }
        });
    });
};
// initMap関数をラップする関数
async function runInitMapAndToggleButtons() {
    // ボタンを無効にする
    document.getElementById('rotate-right').disabled = true;
    document.getElementById('rotate-left').disabled = true;
    document.getElementById('reload').disabled = true;

    // initMap functionが終了するまで待つ
    await initMap();

    // ボタンを再び有効にする
    document.getElementById('rotate-right').disabled = false;
    document.getElementById('rotate-left').disabled = false;
    document.getElementById('reload').disabled = false;
}
// Create zoom in and zoom out functionalities
runInitMapAndToggleButtons();
document.getElementById('rotate-left').addEventListener('click', function() {
    map.setHeading(map.getHeading() - 45);
    model.rotation.y -= Math.PI / 4;
});

document.getElementById('rotate-right').addEventListener('click', function() {
    map.setHeading(map.getHeading() + 45);
    model.rotation.y += Math.PI / 4;
});
document.getElementById('reload').addEventListener('click', async function() {
    await runInitMapAndToggleButtons();
    model.rotation.y = Math.PI;
});
}

initialize();