<?php
    use App\Enums\BookCategoryType;
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('books.update', $book->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="title" value="タイトル" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $book->title)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div>
                            <x-input-label for="category" value="カテゴリ" />
                            <select id="category" name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="" disabled selected style="display:none;"></option>
                                <option value="{{ BookCategoryType::NOVEL }}" @if(old('category', $book->category)==BookCategoryType::NOVEL) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::NOVEL) }}</option>
                                <option value="{{ BookCategoryType::SPORTS }}" @if(old('category', $book->category)==BookCategoryType::SPORTS) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::SPORTS) }}</option>
                                <option value="{{ BookCategoryType::PROGRAMMING }}" @if(old('category', $book->category)==BookCategoryType::PROGRAMMING) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::PROGRAMMING) }}</option>
                                <option value="{{ BookCategoryType::BUSINESS }}" @if(old('category', $book->category)==BookCategoryType::BUSINESS) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::BUSINESS) }}</option>
                                <option value="{{ BookCategoryType::OTHER }}" @if(old('category', $book->category)==BookCategoryType::OTHER) selected @endif>{{ BookCategoryType::getDescription(BookCategoryType::OTHER) }}</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>
                        <div>
                            <x-input-label for="tag" value="タグ" />
                            <div class="flex">
                                @foreach($tags as $tag)
                                <div class="flex items-center mr-4">
                                    @empty(old('book_tags'))
                                    <input id="checkbox{{ $tag->id }}" type="checkbox" name="book_tags[]" value="{{ $tag->id }}"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                        {{ $book->tags->contains('id', $tag->id) ? 'checked' : '' }}>
                                    @else
                                    <input id="checkbox{{ $tag->id }}" type="checkbox" name="book_tags[]" value="{{ $tag->id }}"
                                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                        {{ in_array($tag->id, (array)old('book_tags')) ? 'checked' : '' }}>
                                    @endempty
                                    <label for="checkbox{{ $tag->id }}" class="ml-2 text-sm font-medium">{{ $tag->name }}</label>
                                </div>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('tag')" />
                        </div>
                        <div>
                            <x-input-label for="author" value="著者" />
                            <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" :value="old('author', $book->author)" />
                            <x-input-error class="mt-2" :messages="$errors->get('author')" />
                        </div>
                        <div>
                            <x-input-label for="purchase_date" value="購入日" />
                            <x-text-input id="purchase_date" name="purchase_date" type="date" class="mt-1 block w-full" :value="old('purchase_date', $book->format_ymd_purchase_date)" />
                            <x-input-error class="mt-2" :messages="$errors->get('purchase_date')" />
                        </div>
                        <div>
                            <x-input-label for="evaluation" value="評価" />
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="1" @if(old('evaluation', $book->evaluation)=='1') checked @endif> 1</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="2" @if(old('evaluation', $book->evaluation)=='2') checked @endif> 2</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="3" @if(old('evaluation', $book->evaluation)=='3') checked @endif> 3</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="4" @if(old('evaluation', $book->evaluation)=='4') checked @endif> 4</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="5" @if(old('evaluation', $book->evaluation)=='5') checked @endif> 5</x-input-label>
                            <x-input-error class="mt-2" :messages="$errors->get('evaluation')" />
                        </div>
                        <div>
                            <x-input-label for="purchase_date" value="画像" />
                            <div v-if="edit">
                                @if (!empty($book->img_file_name))
                                <img src="{{ asset('storage/'.$book->img_file_name) }}" width="100" height="100">
                                <button type="button" v-on:click="edit=false"
                                    class="btn_delete mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">削除</button>
                                <input type="hidden" name="img_file_name" value="{{ $book->img_file_name }}">
                                @else
                                <x-text-input id="img_file" name="img_file" type="file" class="mt-1 block w-full text-sm border cursor-pointer" />
                                <x-input-error class="mt-2" :messages="$errors->get('img_file')" />
                                @endif
                            </div>
                            <div v-else>
                                <x-text-input id="img_file" name="img_file" type="file" class="mt-1 block w-full text-sm border cursor-pointer" />
                                <x-input-error class="mt-2" :messages="$errors->get('img_file')" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="memo" value="メモ" />
                            <textarea id="memo" name="memo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="6">{{ old('memo', $book->memo) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('memo')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">戻る</a>
                            <x-primary-button>更新する</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="footer_script">
        <script>
            Vue.createApp({
                data() {
                    return {
                        edit: true
                    }
                },
            }).mount('#app');
        </script>
    </x-slot>
</x-app-layout>
