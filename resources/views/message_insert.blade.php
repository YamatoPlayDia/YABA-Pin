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
            background-image: url('assets/img/basic.png');
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="flex items-center justify-cente bg-blue-500 min-h-screen px-2 lg:px-0">
    {{-- フォーム --}}
    <div class="p-6 w-full">
        <form id="messageForm">
            @csrf
            <div class="mb-4">
                <textarea id="himitsu" name="himitsu" rows="10" class="w-full p-2 border rounded"></textarea>
            </div>
            <input type="hidden" id="writer_id" name="writer_id" value="{{ Auth::id() }}">
            <div class="flex justify-center">
                <button type="submit" class="bg-indigo-900 text-white py-2 px-4 rounded">
                    ひみつをなげる
                </button>
            </div>
        </form>
    </div>
    <!-- Custom JS -->
    @vite('resources/js/create_message.js')
</body>
</html>
