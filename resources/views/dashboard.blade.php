<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Welcome, {{ auth()->user()->name }}</h1>
                </div>
            </div>
        </div>

        <div class="fixed bottom-0 right-0 mb-10 mr-8 z-50">
            <div class="bg-white overflow-hidden shadow-sm rounded-full w-28 h-28 p-6 text-center flex items-center justify-center">
                <a href="{{ route('message_insert') }}">ひみつを<br>なげる</a>
            </div>
            <div class="mt-8 bg-white overflow-hidden shadow-sm rounded-full w-28 h-28 p-6 text-center flex items-center justify-center">
                <a href="#">ひみつを<br>ひろう</a>
            </div>
        </div>
        
    </div>
</x-app-layout>
