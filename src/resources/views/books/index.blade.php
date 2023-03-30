<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') == 'books-stored')
            <div class="mb-4 font-medium text-sm text-green-600">新規登録が完了しました。</div>
            @elseif (session('status') == 'books-updated')
            <div class="mb-4 font-medium text-sm text-green-600">更新が完了しました。</div>
            @elseif (session('status') == 'books-deleted')
            <div class="mb-4 font-medium text-sm text-green-600">削除が完了しました。</div>
            @endif
            <div class="pb-4">
                <a href="{{ route('books.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">新規登録</a>
            </div>
            <table class="w-full">
                <tr>
                    <th>タイトル</th>
                    <th>カテゴリ</th>
                    <th>著者</th>
                    <th>購入日</th>
                    <th>評価</th>
                    <th>ステータス</th>
                    <th>メモ</th>
                    <th></th>
                </tr>
                @foreach ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->category_text }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->display_purchase_date }}</td>
                    <td>{{ $book->evaluation }}</td>
                    <td>{{ $book->status }}</td>
                    <td>{{ $book->memo }}</td>
                    <td>
                        <form method="post" action="{{ route('books.destroy', $book->id) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('books.show', $book->id) }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">詳細</a>
                            <a href="{{ route('books.edit', $book->id) }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">編集</a>
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
