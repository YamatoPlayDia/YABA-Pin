import { getUserID, getOne } from './api.js';
async function initialize() {
const uid = await getUserID();
const footprint = await getOne('footprints', uid);

if( footprint.rights_read == 1 ){
    document.getElementById('rightsBottle').setAttribute('src', 'img/kara_fullbottle.png');
}
else if( footprint.rights_read == 0 ){
    document.getElementById('rightsBottle').setAttribute('src', 'img/kara_karabottle.png');
}
}

initialize();