import { getUserID, getOne, create, getAll } from './api.js';
async function initialize() {
const uid = await getUserID();
let footprints = await getAll('footprints');

// Find the footprint for the given user ID
let footprint = footprints.find(footprint => footprint.id === uid);

// If the footprint doesn't exist, create it
if (!footprint) {
    const newFootprintData = {
        id: uid,
        rights_write: 1,
        rights_read: 0
    };
    await create('footprints', newFootprintData);

    // Get the newly created footprint
    footprint = await getOne('footprints', uid);
}
if( footprint.rights_read == 1 ){
    document.getElementById('rightsBottle').setAttribute('src', 'img/kara_fullbottle.png');
}
else if( footprint.rights_read == 0 ){
    document.getElementById('rightsBottle').setAttribute('src', 'img/kara_karabottle.png');
}
}

initialize();