<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shops') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') == 'books-deleted')
            <div class="mb-4 font-medium text-sm text-green-600">削除が完了しました。</div>
            @endif
            <div class="pb-4">
                <a href="{{ route('shops.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">新規登録</a>
            </div>
            <table class="w-full">
                <tr>
                    <th>名前</th>
                    <th>住所</th>
                </tr>
                @foreach ($shops as $shop)
                <tr>
                    <td>{{ $shop->name }}</td>
                    <td>{{ $shop->address }}</td>
                    <td>
                        <form method="post" action="{{ route('shops.destroy', $shop->id) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('shops.show', $shop->id) }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">詳細</a>
                            <a href="{{ route('shops.edit', $shop->id) }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">編集</a>
                            <button type="submit" onClick="return clickDelete()" class="delete-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <x-slot name="footer_script">
        <script>
            function clickDelete() {
                if(!confirm('削除してもよろしいですか？')){
                    return false;
                }
            }
        </script>
    </x-slot>
</x-app-layout>
