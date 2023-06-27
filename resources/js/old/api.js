import { handleError } from './functions.js';

export function getProfiles() {
    return fetch('/api/profiles').then(response => response.json()).catch(handleError);
}

export function getProfile(id) {
    return fetch(`/api/profiles/${id}`).then(response => response.json()).catch(handleError);
}

export function deleteProfile(id) {
    return fetch(`/api/profiles/${id}`, {
        method: 'DELETE'
    }).then(response => response.json()).catch(handleError);
}

export function updateProfile(id, data) {
    return fetch(`/api/profiles/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => response.json()).catch(handleError);
}

export function createProfile(data) {
    return fetch('/api/profiles', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    }).then(response => response.json()).catch(handleError);
}
