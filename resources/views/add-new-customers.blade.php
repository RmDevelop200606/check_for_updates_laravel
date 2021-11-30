<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('corsin') }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">新規顧客エクセルファイルアップロード</h1>
                @if ($message != null)
                    <div class="text-red-500 text-center">{{$message}}</div>
                @endif
            </div>


            <!-- ▼フォーム -->
            <form action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end">
                    <div class="relative flex-grow w-full">
                        <input type="file" id="file" name="file" class="form-control">
                    </div>
                    <input type="submit" value="アップロード" required onclick="return confirm('新規顧客の追加を行います。よろしいですか？')" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg whitespace-nowrap">
                </div>
            </form>
            <!-- ▲フォーム -->
        </div>
    </section>
</x-app-layout>
