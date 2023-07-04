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
            <p id="himitsu" data-text=""></p>
        </div>
        {{-- ボタン --}}
        <div class="absolute bottom-48 w-full flex justify-center">
            <button id="submit" class="yabapin_btn bg-indigo-900 text-white py-2 px-4 rounded" style="display: none; opacity: 0; transition: opacity 2s;">
                秘密を手放す
            </button>
        </div>
    </main>
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
    @vite('resources/js/reading_message.js')
    @vite('resources/js/typing.js')
</body>
</html>