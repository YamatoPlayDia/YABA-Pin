import{g as r,d as a,c as o,a as n}from"./api-e53b87f9.js";import"./functions-5aea6087.js";async function s(){const i=await r();let t=(await a("footprints")).find(e=>e.id===i);t||(await o("footprints",{id:i,rights_write:1,rights_read:0}),t=await n("footprints",i)),t.rights_read==1?document.getElementById("rightsBottle").setAttribute("src","img/kara_fullbottle.png"):t.rights_read==0&&document.getElementById("rightsBottle").setAttribute("src","img/kara_karabottle.png")}s();
