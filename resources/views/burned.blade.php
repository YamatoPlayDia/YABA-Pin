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

        img {
            transform-origin:0 50%;
            transform:rotate(-90deg);
        }
    </style>
</head>
<body class="flex justify-center">
    <main class="flex flex-col min-h-screen w-screen">
        {{-- 秘密を見る権利 --}}
        <div class="flex justify-end py-1 px-1">
            <table>
                <td>
                    <div>ひろえる！</div>
                </td>
                <td>
                    <div>
                        <img src="assets/img/palebottole.png" style="width:42px">
                    </div>
                </td>
            </table>
        </div>

        {{-- メッセージ画面 --}}
        <div id="burnedBtn" class="leading-relaxed text-s text-blue-900 bg-neutral-50 bg-opacity-70 py-4 px-4 mx-4 mt-auto mb-8">
            <p>秘密は消えてしまいました。</p>
            <p>また新たな秘密を瓶に託しましょう…</p>
        </div>
    </main>
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
    @vite('resources/js/burned.js')
</body>
</html>