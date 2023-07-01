<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- CSS only -->
     @vite('resources/css/app.css')
</head>
<body class="flex justify-center">
    <main class="bg-blue-500 flex flex-col min-h-screen w-screen">
        {{-- 秘密を見る権利
        <div class="flex justify-end py-1 px-1">
            ⭐️⭐️⭐️
        </div> --}}
        {{-- メッセージ画面 --}}
        <div class="text-xs bg-neutral-50 bg-opacity-70 py-4 px-4 mx-4 mt-auto mb-4">
            <p>秘密を瓶に託しました。</p>
            <p>またひとつ、</p>
            <p>あなたは誰かの秘密を知ることになる…</p>
        </div>
    </main>
</body>
</html>