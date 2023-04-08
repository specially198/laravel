<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shops') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="border-t">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">名前</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $shop->name }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">住所</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $shop->address }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('shops.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">戻る</a>
            </div>
        </div>
    </div>
</x-app-layout>
