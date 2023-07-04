<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6 text-xl text-white message">
                    <p id="p1" data-text='Welcome, {{ auth()->user()->name }}'></p>
                </div>
            </div>
        </div>

        <div class="fixed bottom-0 right-0 mb-10 mr-8 z-50">
            <div id="throwBtn" class="hidden bg-white overflow-hidden shadow-sm rounded-full w-28 h-28 p-6 text-center flex items-center justify-center">
                <p>秘密を<br>なげる</p>
            </div>
            <div id="readBtn" class="mt-8 hidden bg-white overflow-hidden shadow-sm rounded-full w-28 h-28 p-6 text-center flex items-center justify-center">
                <p>秘密を<br>ひろう</p>
            </div>
            <div id="readStillBtn" class="mt-8 hidden bg-white overflow-hidden shadow-sm rounded-full w-28 h-28 p-6 text-center flex items-center justify-center">
                <p>秘密を<br>よむ</p>
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
    @vite('resources/js/app.js')
    <!-- Custom JS -->
    @vite('resources/js/dashboard.js')
    @vite('resources/js/typing.js')
</x-app-layout>
