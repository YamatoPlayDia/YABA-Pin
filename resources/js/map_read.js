
import { mapOptions } from './mapConfig';
let map;
let currentPosition;
import * as THREE from 'three';
import { MTLLoader } from 'three/examples/jsm/loaders/MTLLoader';
import { OBJLoader } from 'three/examples/jsm/loaders/OBJLoader';
let scene, camera, renderer, model;

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
        model.rotation.y += Math.PI;
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
    const { PlacesService, PlacesServiceStatus } = await google.maps.importLibrary("places");

    // Use the browser's built-in Geolocation API to get the current location.
    navigator.geolocation.getCurrentPosition(async function (position) {
        const currentPosition = {
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

        const pin = new PinElement({
            background: "#db8555",
            borderColor: "#f8c967",
            glyphColor: "#f8c967",
            scale: 2.0,
        });

        let markers = [];

        // そして、各マーカーを作成するときにその配列に追加します：
        const markerView = new AdvancedMarkerElement({
            map,
            content: pin.element,
            position: currentPosition,
        });

        markers.push(markerView);

        // 現在地のマーカーに対してクリックイベントを追加します：
        markerView.addListener('click', function() {
            markers.forEach(marker => console.log(marker.position));
        });

        // 地図上のピンをクリックしたときのイベントリスナーを追加します。
        markerView.addListener('click', function() {
            console.log(currentPosition);
        });
        // Create a circle centered at the current position.
        const circle = new google.maps.Circle({
            strokeColor: '#db8555',
            strokeOpacity: 0.8,
            strokeWeight: 3,
            fillColor: '#f8c967',
            fillOpacity: 0.15,
            map: map,
            center: currentPosition,
            radius: 200
        });

        google.maps.event.addListener(circle, 'click', function() {
            markers.forEach(marker => {
                const isInCircle = google.maps.geometry.spherical.computeDistanceBetween(marker.position, circle.getCenter()) <= circle.getRadius();
                if (isInCircle) {
                    console.log(marker.position);
                }
            });
        });

        // Use the PlacesService to find nearby parks.
        const { RankBy } = await google.maps.importLibrary("places");
        // Use the PlacesService to find nearby parks.
        const placesService = new PlacesService(map);
        const request = {
            location: currentPosition,
            // radius: '500', // No longer required when using RankBy.DISTANCE
            rankBy: RankBy.DISTANCE,
            type: ['park'], // Changed type to keyword
        };
        let placeIds = []; // To store unique placeIds
        let nextPageToken = null;
        let delayInMilliseconds = 2000; //two seconds
        placesService.nearbySearch(request, (results, status, pagination) => {
            if (status === PlacesServiceStatus.OK) {
                for (let i = 0; i < results.length; i++) {
                    if (!results[i].types.some(type => request.type.includes(type))) {
                        continue;
                    }
                    if (placeIds.includes(results[i].place_id)) {
                        continue;
                    }
                    placeIds.push(results[i].place_id);

                    const isInCircle = google.maps.geometry.spherical.computeDistanceBetween(results[i].geometry.location, circle.getCenter()) <= circle.getRadius();
                    const placePin = new PinElement({
                        background: isInCircle ? "#447530" : "#b9d3c2",
                        borderColor: isInCircle ? "#a5b076" : "#92998d",
                        glyphColor: isInCircle ? "#a5b076" : "#92998d",
                        scale: 1.0,
                    });

                    const marker = new AdvancedMarkerElement({
                        map,
                        content: placePin.element,
                        position: results[i].geometry.location,
                    });

                    marker.placeId = results[i].place_id;
                    markers.push(marker);

                    function getDirection(degrees) {
                        const directions = ['北', '北東', '東', '南東', '南', '南西', '西', '北西'];
                        const index = Math.round(((degrees %= 360) < 0 ? degrees + 360 : degrees) / 45) % 8;
                        return directions[index];
                    }

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

                            console.log('PlaceId:', place.place_id);
                            console.log('Name:', place.name);
                            console.log('Address:', address);
                            console.log('Latitude:', place.geometry.location.lat());
                            console.log('Longitude:', place.geometry.location.lng());
                            console.log('Distance:', distance + 'm');
                            console.log('Direction:', direction);
                            console.log('Photo URL:', place.photos ? place.photos[0].getUrl() : 'No Photo Available');
                        }
                    });
                }

                if (pagination.hasNextPage) {
                    nextPageToken = pagination.nextPageToken;
                    setTimeout(() => {
                        pagination.nextPage();
                    }, delayInMilliseconds);
                }
            }
        });

    });
};
  // Create zoom in and zoom out functionalities

document.getElementById('rotate-left').addEventListener('click', function() {
    map.setHeading(map.getHeading() - 45);
    model.rotation.y -= Math.PI / 4;
});

document.getElementById('rotate-right').addEventListener('click', function() {
    map.setHeading(map.getHeading() + 45);
    model.rotation.y += Math.PI / 4;
});

initMap();