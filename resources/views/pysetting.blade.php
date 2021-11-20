<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('corsin-Python設定') }}
      </h2>
  </x-slot>
  <div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex justify-around ">


            
            <div>
              <x-nomal-link :url="route('not-active.index')" class="" >
                {{ __("スクレイピング除外タグ") }}
              </x-nomal-link>
            </div>



            {{-- {{ route('tag-to-exlude') }} --}}
            
            <div>
              @if (str_replace(url('/'),"",request()->fullUrl()) == '/pysetting/UrlNgWord')
                <x-nomal-active-link :url="'/pysetting/UrlNgWord'" class="">
                  {{ __("URLスクレイピングNGワード") }}
                </x-nomal-active-link>
              @else
                <x-nomal-link :url="'/pysetting/UrlNgWord'" class="">
                  {{ __("URLスクレイピングNGワード") }}
                </x-nomal-link>
              @endif
            </div>

            {{-- {{ route('tag-to-exlude') }} --}}

            <div>
              @if (str_replace(url('/'),"",request()->fullUrl()) == '/pysetting/UrlOkWord')
                <x-nomal-active-link :url="'/pysetting/UrlOkWord'" class="">
                  {{ __("URLスクレイピングOKワード") }}
                </x-nomal-active-link>
              @else
                <x-nomal-link :url="'/pysetting/UrlOkWord'" class="">
                  {{ __("URLスクレイピングOKワード") }}
                </x-nomal-link>
              @endif
            </div>

            {{-- {{ route('tag-to-exlude') }} --}}
          </div>
          <div>

          </div>
        </div>
      </div>
    </div>
  </div>
  @yield('content')
</x-app-layout>