<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('user.index') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                        {{ __('進捗状況シート') }}
                    </x-nav-link>
                </div>

                <!-- corsin画面 -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('customer-page.index')" :active="request()->routeIs('customer-page.index')">
                        {{ __('顧客一覧') }}
                    </x-nav-link>
                </div>

                <!-- ブログあり -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('hasblog.index')" :active="request()->routeIs('hasblog.index')">
                        {{ __('ブログ有り') }}
                    </x-nav-link>
                </div>

                <!-- ブログ無し -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('noblog.index')" :active="request()->routeIs('noblog.index')">
                        {{ __('ブログ無し') }}
                    </x-nav-link>
                </div>

                <!-- csv出力ページ -->
                @if (Auth::user()->is_admin == 1)
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('csv.index')" :active="request()->routeIs('csv.index')">
                            {{ __('csv出力') }}
                        </x-nav-link>
                    </div>
                @endif

                <!-- 検索 -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('search.index')" :active="request()->routeIs('search.index')">
                        {{ __('検索') }}
                    </x-nav-link>
                </div>
                
                @if(Auth::user()->is_admin == 1)
                    <!-- Python設定 -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('pysetting.index')" :active="request()->routeIs('pysetting.index')">
                            {{ __('Python設定') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- 登録情報編集 --}}
                        <x-dropdown-link :href="route('user.edit', [Auth::user()])">
                            {{ __('登録情報編集') }}
                        </x-dropdown-link>

                        {{-- 成績分析画面 --}}
                        <x-dropdown-link :href="route('user.edit', [Auth::user()])">
                            {{ __('成績一覧') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
                {{ __('進捗状況シート') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- user.index -->
                <x-responsive-nav-link :href="route('user.index')">
                    {{ __('進捗状況シート') }}
                </x-responsive-nav-link>
            </div>

            <div class="mt-3 space-y-1">
                <!-- corsin -->
                <x-responsive-nav-link :href="route('customer.index')">
                    {{ __('corsin') }}
                </x-responsive-nav-link>
            </div>

            <div class="mt-3 space-y-1">
                <!-- ブログ有り　-->
                <x-responsive-nav-link :href="route('hasblog.index')">
                    {{ __('ブログ有り') }}
                </x-responsive-nav-link>
            </div>

            <div class="mt-3 space-y-1">
                <!-- ブログ無し -->
                <x-responsive-nav-link :href="route('noblog.index')">
                    {{ __('ブログ無し') }}
                </x-responsive-nav-link>
            </div>

            @if (Auth::user()->is_admin == 1)
                <div class="mt-3 space-y-1">
                    <!-- csv出力ページ -->
                    <x-responsive-nav-link :href="route('csv.index')">
                        {{ __('csv出力') }}
                    </x-responsive-nav-link>
                </div>
            @endif

            <div class="mt-3 space-y-1">
                <!-- 登録画面編集 -->
                <x-responsive-nav-link :href="route('user.edit', [Auth::user()])">
                    {{ __('登録画面編集') }}
                </x-responsive-nav-link>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
