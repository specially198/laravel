<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ReadingHistories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('reading_histories.update', [$book->id, $reading_history->id]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="finished_date" value="読了日" />
                            <x-text-input id="finished_date" name="finished_date" type="date" class="mt-1 block w-full" :value="old('finished_date', $reading_history->format_ymd_finished_date)" />
                            <x-input-error class="mt-2" :messages="$errors->get('finished_date')" />
                        </div>
                        <div>
                            <x-input-label for="evaluation" value="評価" />
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="1" @if(old('evaluation', $reading_history->evaluation)=='1') checked @endif> 1</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="2" @if(old('evaluation', $reading_history->evaluation)=='2') checked @endif> 2</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="3" @if(old('evaluation', $reading_history->evaluation)=='3') checked @endif> 3</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="4" @if(old('evaluation', $reading_history->evaluation)=='4') checked @endif> 4</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="5" @if(old('evaluation', $reading_history->evaluation)=='5') checked @endif> 5</x-input-label>
                            <x-input-error class="mt-2" :messages="$errors->get('evaluation')" />
                        </div>
                        <div>
                            <x-input-label for="thoughts" value="メモ" />
                            <textarea id="thoughts" name="thoughts" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="6">{{ old('thoughts', $reading_history->thoughts) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('thoughts')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <a href="{{ route('books.show', $book->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">戻る</a>
                            <x-primary-button>更新する</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
