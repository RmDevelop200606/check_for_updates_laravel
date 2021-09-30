<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    こんにちは{{ Auth::user()->name }}さん
                </div>
                @if(Auth::user()->is_admin == 1)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('python') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                            {{ __('差分取得システム始動') }}
                        </a>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('not-active.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                            {{ __('停止中顧客一覧') }}
                        </a>
                    </div>

                    {{-- <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('writecustomerid') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                            {{ __('LineRegisterテーブル、customer_id書き換え') }}
                        </a>
                    </div> --}}
                    
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
