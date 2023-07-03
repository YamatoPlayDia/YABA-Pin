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

const lastReadData = await getOneFromData('messages', 'reader_id', uid);
document.getElementById('burnedBtn').addEventListener('click', async () => {
    // 前提として、draftが適切に定義されていると仮定します
    if(lastReadData.status === '収得済み') {
        const data = {
            ...lastReadData,
            status: '既読'
        };
        await update('messages', lastReadData.id, data);
        window.location.href = '/dashboard';
    } else {
        document.getElementById('burnedBtn').innerHTML = '再読み込みください';
    }
});