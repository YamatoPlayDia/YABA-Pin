import { getProfiles, deleteProfile } from './api.js';

getProfiles().then(profiles => {
    let output = '';
    profiles.forEach(profile => {
        output += `<tr>`;
        output += `<td>${profile.name}</td>`;
        output += `<td>${profile.email}</td>`;
        output += `<td>${profile.profile}</td>`;
        output += `<td>${profile.phone}</td>`;
        output += `<td>`;
        output += `<button type="button" class="btn btn-danger delete" data-uid="${profile.id}">Delete</button>`;
        output += `<a href="/edit?id=${profile.id}" class="btn btn-primary">Edit</a>`;
        output += `</td>`;
        output += `</tr>`;
    });
    document.querySelector('#profileTable tbody').innerHTML = output;

    // Delete button event listeners
    document.querySelectorAll('.delete').forEach(function(button) {
        button.addEventListener('click', function() {
            deleteProfile(button.getAttribute('data-uid')).then(data => {
                console.log('Success:', data);
                location.reload();
            }).catch((error) => {
                console.error('Error:', error);
            });
        });
    });
});