import { getOne, update } from '../api.js';

const params = new URLSearchParams(window.location.search);
const id = params.get('id');

// Fetch profile data
getOne('profiles', id).then(profile => {
    document.getElementById('name').value = profile.name;
    document.getElementById('email').value = profile.email;
    document.getElementById('profile').value = profile.profile;
    document.getElementById('phone').value = profile.phone;
});

// Update profile data
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

    update('profiles', id, data).then(data => {
        console.log('Success:', data);
        alert('Profile updated successfully');
    });
});