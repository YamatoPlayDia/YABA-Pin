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
    <script>
        @if(Auth::check()) <!-- ユーザーが認証されているかチェック -->
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
                'apiToken' => Auth::user()->createToken('Token Name')->plainTextToken // トークンの作成と取得
            ]) !!};
        @endif
    </script>
    <!-- Custom JS -->
    @vite('resources/js/create_message.js')
</body>
</html>
