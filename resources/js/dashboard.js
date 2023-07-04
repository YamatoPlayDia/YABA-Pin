import { update, getOneFromData, getUserID, getOne, create } from './api.js';

async function initialize() {
const uid = await getUserID();
let footprint = await getOne('footprints', uid);
const draft = await getOneFromData('messages', 'writer_id', uid);
const lastReadData = await getOneFromData('messages', 'reader_id', uid);
if (!footprint) {
    const newFootprintData = {
        id: uid,
        rights_write: 1,
        rights_read: 0
    };
    await create('footprints', newFootprintData);
    footprint = await getOne('footprints', uid);
}

if( !lastReadData || lastReadData.status !== '収得済み' ){
    if( footprint.rights_read == 1 ){
        document.getElementById('rightsBottle').setAttribute('src', 'img/kara_fullbottle.png');
        document.getElementById('readBtn').classList.remove('hidden');
        document.getElementById('throwBtn').classList.remove('hidden');
    }
    else if( footprint.rights_read == 0 ){
        document.getElementById('rightsBottle').setAttribute('src', 'img/kara_karabottle.png');
        document.getElementById('throwBtn').classList.remove('hidden');
    }
} else if( lastReadData.status === '収得済み' ){
    if( footprint.rights_read == 1 ){
        document.getElementById('rightsBottle').setAttribute('src', 'img/kara_fullbottle.png');
        document.getElementById('readBtn').classList.remove('hidden');
        document.getElementById('throwBtn').classList.remove('hidden');
    }
    else if( footprint.rights_read == 0 ){
        document.getElementById('rightsBottle').setAttribute('src', 'img/kara_karabottle.png');
        document.getElementById('readStillBtn').classList.remove('hidden');
        document.getElementById('throwBtn').classList.remove('hidden');
    }
} else {
    const handleFootprintData = {
        ...footprint,
        rights_read: 0,
    };
    await update('footprints', uid, handleFootprintData);
    document.getElementById('rightsBottle').setAttribute('src', 'assets/img/palebottole.png');
    document.getElementById('throwBtn').classList.remove('hidden');
}


document.getElementById('throwBtn').addEventListener('click', async () => {
    // 前提として、draftが適切に定義されていると仮定します
    if( !draft || draft.status !== '下書き') {
        const data = {
            writer_id: uid,
            himitsu: 'あなたの秘密をここにお書きください',
            status: '下書き'
        };
        await create('messages', data);
        window.location.href = '/message_insert';
    } else if ( draft.status === '下書き' ) {
        window.location.href = '/message_insert';
    }
});


document.getElementById('readBtn').addEventListener('click', async () => {
    // 前提として、draftが適切に定義されていると仮定します
    if(!lastReadData || lastReadData.status !== '収得済み') {
        window.location.href = '/map_read';
    } else if ( lastReadData.status === '収得済み' ) {
        window.location.href = '/reading_view';
    }
});

document.getElementById('readStillBtn').addEventListener('click', async () => {
    // 前提として、draftが適切に定義されていると仮定します
    if(!lastReadData || lastReadData.status !== '収得済み') {
        window.location.href = '/map_read';
    } else if ( lastReadData.status === '収得済み' ) {
        window.location.href = '/reading_view';
    }
});
}

initialize();