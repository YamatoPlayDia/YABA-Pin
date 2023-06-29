import { create } from './api.js';

document.getElementById('messageForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let writer_id = document.getElementById('writer_id').value;
    let himitsu = document.getElementById('himitsu').value;
    

    let data = {
        writer_id: writer_id,
        himitsu: himitsu,
        
    };

    create('messages', data).then(data => {
        console.log('Success:', data);
        alert('Message created successfully');
    });
});