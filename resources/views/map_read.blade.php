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
    @include('components.bottle')
<div id="3d-model" class="overlay"></div>
<div id="map-container">
    <div id="map"></div>
    {{-- <div id="info-container" class="flex overflow-x-auto p-4 absolute bottom-0 w-full"></div> --}}
</div>
{{-- <div id="3d-model" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);"></div> --}}
<div id="zoom-control">
    <button id="rotate-right" class="circle-button bg-black h-10 w-10">
        <img src="img/right.png" class="h-10 w-10 mx-auto">
    </button>
    <button id="rotate-left" class="circle-button bg-black h-10 w-10">
        <img src="img/left.png" class="h-10 w-10 mx-auto">
    </button>
    <button id="reload" class="circle-button bg-black h-10 w-10">
        <img src="img/update.png" class="h-10 w-10 mx-auto">
    </button>
</div>
<div id="cards-slider" class="flex overflow-x-auto p-4 mb-4 absolute bottom-0 w-full hidden-scrollbar">
    <div class="flex-none w-64 h-48 mr-4 mb-4 bg-white rounded-xl shadow-lg flex flex-col justify-between">
        <img src="img/type-park.png" class="w-full h-2/5 object-cover rounded-t-xl">
        <div class="p-3">
            <p class="text-xs text-gray-500"></p>
            <h2 class="text-base font-semibold">・・・</h2>
            <p class="text-xs text-gray-400"></p>
        </div>
        <button class="p-3 text-sm bg-gray-500 text-white rounded-b-xl">・・・</button>
    </div>
    <div class="flex-none w-64 h-48 mr-4 mb-4 bg-white rounded-xl shadow-lg flex flex-col justify-between">
        <img src="img/type-park.png" class="w-full h-2/5 object-cover rounded-t-xl">
        <div class="p-3">
            <p class="text-xs text-gray-500"></p>
            <h2 class="text-base font-semibold">・・・</h2>
            <p class="text-xs text-gray-400"></p>
        </div>
        <button class="p-3 text-sm bg-gray-500 text-white rounded-b-xl">・・・</button>
    </div>
</div>
<div id="myModal" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            再読み込みをしてください
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- prettier-ignore -->
        <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
            ({key: "AIzaSyCAG2YEDYixE9zNbBckshdHLm3AHlLHuyE", v: "beta"});</script>
        <script>
            @if(Auth::check()) <!-- ユーザーが認証されているかチェック -->
                window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
                    'apiToken' => Auth::user()->createToken('Token Name')->plainTextToken // トークンの作成と取得
                ]) !!};
            @endif
        </script>
    @vite('resources/js/app.js')
    <!-- Custom JS -->
    @vite('resources/js/map_read.js')
</body>
</html>
