import { getAll, remove } from './api.js';

getAll('profiles').then(profiles => {
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
            remove('profiles', button.getAttribute('data-uid')).then(data => {
                console.log('Success:', data);
                location.reload();
            });
        });
    });
});