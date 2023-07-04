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
const lastReadData = await getOneFromData('messages', 'writer_id', uid);
document.getElementById('himitsu').setAttribute('data-text', lastReadData.himitsu);

document.getElementById('submit').addEventListener('click', function(event) {
    event.preventDefault();
    if(lastReadData.status === '収得済み') {
        const data = {
            ...lastReadData,
            status: '既読'
        };
        update('messages', lastReadData.id, data).then(data => {
            console.log('Success:', data);
        });
        window.location.href = '/burning';
    } else {
        document.getElementById('burnedBtn').innerHTML = '再読み込みください';
    }
});