import { create } from './api.js';

document.getElementById('spotForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let type = document.getElementById('type').value;
    let name = document.getElementById('name').value;
    let gmpid = document.getElementById('gmpid').value;
    let latitude = parseFloat(document.getElementById('latitude').value);
    let longitude = parseFloat(document.getElementById('longitude').value);

    let data = {
        type: type,
        name: name,
        latitude: latitude,
        longitude: longitude,
        gmpid: gmpid,
    };

    create('spots', data).then(data => {
        console.log('Success:', data);
        alert('Spot created successfully');
    });
});