<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="border-t">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">タイトル</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $book->title }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">カテゴリ</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $book->category_text }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">著者</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $book->author }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">購入日</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $book->display_purchase_date }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">評価</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $book->evaluation }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">ステータス</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $book->status }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">メモ</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $book->memo }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">戻る</a>
            </div>
        </div>
    </div>
</x-app-layout>
