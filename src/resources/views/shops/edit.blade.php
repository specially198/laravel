<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shops') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('shops.update_confirm', $shop->id) }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" value="名前" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $shop->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="address" value="住所" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $shop->address)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <a href="{{ route('shops.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">戻る</a>
                            <x-primary-button>入力内容を確認する</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
