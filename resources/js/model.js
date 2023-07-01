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