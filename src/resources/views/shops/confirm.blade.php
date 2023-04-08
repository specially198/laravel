<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shops') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{ !isset($shop) ? route('shops.store') : route('shops.update', $shop->id) }}" class="mt-6 space-y-6">
                @csrf
                @isset($shop)
                    @method('PUT')
                @endisset
                <input type="hidden" name="name" value="{{ $inputs['name'] }}">
                <input type="hidden" name="address" value="{{ $inputs['address'] }}">

                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="border-t">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium">名前</dt>
                                <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $inputs['name'] }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium">住所</dt>
                                <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $inputs['address'] }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="mt-4">
                    <x-primary-button name="back">修正する</x-primary-button>
                    <x-primary-button>{{ !isset($shop) ? 'この内容で登録する' : 'この内容で更新する' }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
