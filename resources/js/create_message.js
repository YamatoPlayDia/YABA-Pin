import { update, getOneFromData, getUserID, getOne } from './api.js';

const uid = await getUserID();
let footprint = await getOne('footprints', uid);
if (!footprint) {
    const newFootprintData = {
        id: uid,
        rights_write: 1,
        rights_read: 0
    };
    await create('footprints', newFootprintData);
    footprint = await getOne('footprints', uid);
}
const draft = await getOneFromData('messages', 'writer_id', uid);
document.getElementById('himitsu').textContent = draft.himitsu;

document.getElementById('messageForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let writer_id = document.getElementById('writer_id').value;
    let himitsu = document.getElementById('himitsu').value;

    let data = {
        ...draft,
        writer_id: writer_id,
        himitsu: himitsu,
        status: '下書き'
    };

    update('messages', draft.id, data).then(data => {
        console.log('Success:', data);
    });
    window.location.href = '/map_throw';
});