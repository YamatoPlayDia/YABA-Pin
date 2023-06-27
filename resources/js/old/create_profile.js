import { createProfile } from './api.js';

document.getElementById('profileForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let profile = document.getElementById('profile').value;
    let phone = document.getElementById('phone').value;

    let data = {
        name: name,
        email: email,
        profile: profile,
        phone: phone
    };

    createProfile(data).then(data => {
        console.log('Success:', data);
        alert('Profile created successfully');
    });
});
