// api.js
export function getProfiles() {
    return fetch('/api/profiles').then(response => response.json());
}

export function getProfile(id) {
    return fetch(`/api/profiles/${id}`).then(response => response.json());
}

export function deleteProfile(id) {
    return fetch(`/api/profiles/${id}`, {
        method: 'DELETE'
    }).then(response => response.json());
}

export function updateProfile(id, data) {
    return fetch(`/api/profiles/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => response.json());
}

export function createProfile(data) {
    return fetch('/api/profiles', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    }).then(response => response.json());
}