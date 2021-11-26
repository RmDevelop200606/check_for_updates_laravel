<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('corsin') }}
        </h2>
    </x-slot>

<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">CSV出力条件選択</h1>
        </div>
        <!-- ▼フォーム -->
        <form action="{{ route('csv.makecsv', $post) }}" method="POST">
            @csrf
            <div class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end">
                    <div class="relative flex-grow w-full">
                        <label for="updated" class="leading-7 text-sm text-gray-600">Blog</label>
                        <select name="updated" required class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option value="">---</option>
                            <option value=0>更新なし</option>
                            <option value=1>更新あり</option>
                        </select>
                    </div>
                    <div class="relative flex-grow w-full">
                        <label for="lineStatus" class="leading-7 text-sm text-gray-600">LINE</label>
                        <select name="lineStatus" required class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option value="">---</option>
                            <option value=0>登録なし</option>
                            <option value=1>登録あり</option>
                        </select>
                    </div>
                    <input type="submit" value="出力" onclick="return confirm('CSVを発行します。よろしいですか？')" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg whitespace-nowrap">
                </div>
            </div>
        </form>
        <!-- ▲フォーム -->
</section>
</x-app-layout>
