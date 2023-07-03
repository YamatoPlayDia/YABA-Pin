<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
    @vite('resources/css/app.css')
    <style>
        body {
            background-image: url('assets/img/letter.png');
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="flex justify-center">
    <main class="message relative bg-blue-900 bg-opacity-60 flex flex-col min-h-screen w-screen"  style="opacity: 0; transition: opacity 2.5s;">
        {{-- 秘密を見る権利 --}}
        @include('components.bottle')
        {{-- メッセージ画面 --}}
        <div class="leading-relaxed text-s text-white py-4 px-8 mx-4 absolute" style="top: 150px;">
            <p id="p1" data-text="ダミーテキストだよ！僕は昔、長距離走大会で振舞われた特大の餅（1枚が普通の4個分くらい）を5枚平らげたことがあるよ！"></p>
        </div>
    </main>
    {{-- js --}}
    @vite('resources/js/typing.js')
</body>
</html>