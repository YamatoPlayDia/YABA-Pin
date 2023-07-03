<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- CSS only -->
     @vite('resources/css/app.css')
     <style>
        body {
            background-image: url('assets/img/pochon.png');
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }


    </style>
</head>
<body class="flex justify-center">
    <main class="bg-blue-900 bg-opacity-60 flex flex-col min-h-screen w-screen">
        {{-- 秘密を見る権利 --}}
        @include('components.bottle')
        {{-- メッセージ画面 --}}
        <div class="leading-relaxed text-s text-blue-900 bg-neutral-50 bg-opacity-70 py-4 px-4 mx-4 mt-auto mb-8">
            <p>秘密を瓶に託しました。</p>
            <p>またひとつ、</p>
            <p>あなたは誰かの秘密を知ることになる…</p>
        </div>
    </main>
</body>
</html>