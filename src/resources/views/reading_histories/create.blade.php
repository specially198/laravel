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
                    <form method="post" action="{{ route('reading_histories.store', $book->id) }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="finished_date" value="読了日" />
                            <x-text-input id="finished_date" name="finished_date" type="date" class="mt-1 block w-full" :value="old('finished_date')" />
                            <x-input-error class="mt-2" :messages="$errors->get('finished_date')" />
                        </div>
                        <div>
                            <x-input-label for="evaluation" value="評価" />
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="1" @if(old('evaluation')=='1') checked @endif> 1</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="2" @if(old('evaluation')=='2') checked @endif> 2</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="3" @if(old('evaluation')=='3') checked @endif> 3</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="4" @if(old('evaluation')=='4') checked @endif> 4</x-input-label>
                            <x-input-label><input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="radio" name="evaluation" value="5" @if(old('evaluation')=='5') checked @endif> 5</x-input-label>
                            <x-input-error class="mt-2" :messages="$errors->get('evaluation')" />
                        </div>
                        <div>
                            <x-input-label for="thoughts" value="感想" />
                            <textarea id="thoughts" name="thoughts" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="6">{{ old('thoughts') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('thoughts')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>登録する</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
