<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    こんにちは{{ Auth::user()->name }}さん
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center p-4">(▼現在制作中)<br>ブログ導入顧客({{$record['blogCustomersAll']}}件)</div>
                    <div class="h-full p-4">
                        <canvas id="blog" data-blog="{{$record['updated']}}" data-all="{{$record['blogCustomersAll']}}" height="50px" class=""></canvas>
                        <script src="{{ asset('js/blog-bar-chart.js') }}" defer></script>
                        </div>


                        <div class="flex">
                            <!-- メールアドレスの円グラフ（未実装） -->
                            <div class="w-1/3 p-4">
                                <canvas id="mail" data-mail="0" data-all="{{$record['blogCustomersAll']}}"></canvas>
                                <script src="{{ asset('js/mail-chart.js') }}" defer></script>
                            </div>

                            <!-- ライン登録の円グラフ -->
                            <div class="w-1/3 p-4 relative">
                                <canvas id="LineRegister" data-line="{{$record['line']}}" data-all="{{$record['blogCustomersAll'] - $record['line']}}"></canvas>
                                <script src="{{ asset('js/line-chart.js') }}" defer></script>
                                <div class="w-full absolute inset-1/2 font-bold text-gray-500">
                                    <p>{{$record['lineRegisterRate']}}%</p>
                                    <p>{{$record['line']}}件</p>
                                </div>
                            </div>

                            <!-- アクティブコールの円グラフ -->
                            <div class="w-1/3 p-4 relative">
                                <canvas id="call" data-call="{{$record['activeCall']}}" data-all="{{$record['blogCustomersAll'] - $record['activeCall']}}"></canvas>
                                <script src="{{ asset('js/call-chart.js') }}" defer></script>
                                <div class="w-full absolute inset-1/2 font-bold text-gray-500">
                                    <p>{{$record['activeCallRate']}}%</p>
                                    <p>{{$record['activeCall']}}件</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ▼管理者メニュー --}}
                @if(Auth::user()->is_admin == 1)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('not-active.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                            {{ __('停止中顧客一覧') }}
                        </a>
                    </div>

                    {{-- Lineテーブルへcustomer_idの書き込み（エクセル→DBにデータ移行するとき必要、120秒でタイムアウトするが、くじけず５回くらい実行する） --}}
                    {{-- <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('writecustomerid') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                            {{ __('LineRegisterテーブル、customer_id書き換え') }}
                        </a>
                    </div> --}}

                @endif
                {{-- ▲管理者メニュー --}}
            </div>
        </div>
    </div>
</x-app-layout>
