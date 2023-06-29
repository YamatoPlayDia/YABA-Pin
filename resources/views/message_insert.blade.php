<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- CSS only -->
     @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-blue-500 px-2 lg:px-0">
    {{-- フォーム --}}
    <div class="p-6 w-full">
        <form id="messageForm">
            <div class="mb-4">
                <textarea id="himitsu" name="himitsu" rows="10" class="w-full p-2 border rounded"></textarea>
            </div>
            <input type="hidden" id="writer_id" name="writer_id" value="{{ Auth::id() }}">
            <div class="flex justify-center">
                <button type="submit" class="bg-indigo-900 text-white py-2 px-4 rounded">
                    送信
                </button>
            </div>
        </form>
    </div>
</body>
</html>
