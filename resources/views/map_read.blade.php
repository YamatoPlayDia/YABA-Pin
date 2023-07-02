<!DOCTYPE html>
<html>
<head>
    <title>Create Profile</title>
    <!-- CSS only -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    @vite('resources/css/map.css')
</head>
<body>
<div id="3d-model" class="overlay"></div>
<div id="map-container">
    <div id="map"></div>
    {{-- <div id="info-container" class="flex overflow-x-auto p-4 absolute bottom-0 w-full"></div> --}}
</div>
{{-- <div id="3d-model" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);"></div> --}}
<div id="zoom-control">
    <button id="rotate-right" class="circle-button bg-white">
        <svg class="h-6 w-6 text-black mx-auto transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
    <button id="rotate-left" class="circle-button bg-white">
        <svg class="h-6 w-6 text-black mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    <button id="reload" class="circle-button bg-white">
        <svg class="h-6 w-6 text-black mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.668 9H15.5l1.528-1.528a4 4 0 0 0-5.646-5.646l-1.714 1.713-1.415-1.415L17.668 9zm-4.5 5.472L11.756 15a4 4 0 1 0 5.648 5.648l1.714-1.714 1.415 1.415-1.715 1.714H6"></path>
        </svg>
    </button>
</div>
<div id="cards-slider" class="flex overflow-x-auto p-4 mb-4 absolute bottom-0 w-full hidden-scrollbar">
    <div class="flex-none w-64 h-48 mr-4 mb-4 bg-white rounded-xl shadow-lg flex flex-col justify-between">
        <img src="img/type-park.png" class="w-full h-2/5 object-cover rounded-t-xl">
        <div class="p-3">
            <p class="text-xs text-gray-500"></p>
            <h2 class="text-lg font-semibold">・・・</h2>
            <p class="text-xs text-gray-400"></p>
        </div>
        <button class="p-3 text-sm bg-gray-500 text-white rounded-b-xl">・・・</button>
    </div>
    <div class="flex-none w-64 h-48 mr-4 mb-4 bg-white rounded-xl shadow-lg flex flex-col justify-between">
        <img src="img/type-park.png" class="w-full h-2/5 object-cover rounded-t-xl">
        <div class="p-3">
            <p class="text-xs text-gray-500"></p>
            <h2 class="text-lg font-semibold">・・・</h2>
            <p class="text-xs text-gray-400"></p>
        </div>
        <button class="p-3 text-sm bg-gray-500 text-white rounded-b-xl">・・・</button>
    </div>
</div>

        <!-- prettier-ignore -->
        <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
            ({key: "AIzaSyCAG2YEDYixE9zNbBckshdHLm3AHlLHuyE", v: "beta"});</script>
    @vite('resources/js/app.js')
    <!-- Custom JS -->
    @vite('resources/js/map_read.js')
</body>
</html>
