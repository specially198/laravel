<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') == 'reading_histories-stored')
            <div class="mb-4 font-medium text-sm text-green-600">読書記録の新規登録が完了しました。</div>
            @elseif (session('status') == 'reading_histories-updated')
            <div class="mb-4 font-medium text-sm text-green-600">読書記録の更新が完了しました。</div>
            @elseif (session('status') == 'reading_histories-deleted')
            <div class="mb-4 font-medium text-sm text-green-600">読書記録の削除が完了しました。</div>
            @endif
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">本の内容</h3>
                </div>
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
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">タグ</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                                @foreach($book->tags as $tag)
                                    {{ $tag->name }}
                                @endforeach
                            </dd>
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
                            <dt class="text-sm font-medium">画像</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">
                                @if (!empty($book->img_file_name))
                                <img src="{{ asset('storage/'.$book->img_file_name) }}" width="100" height="100">
                                <a href="{{ route('books.download', $book->id) }}" class="mt-1 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">ダウンロード</a>
                                @endif
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">ステータス</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $book->status }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium">メモ</dt>
                            <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{!! nl2br(e($book->memo)) !!}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="overflow-hidden bg-white shadow sm:rounded-lg mt-4 pb-4">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-base font-semibold leading-6 text-gray-900">読書記録</h3>
                </div>
                <div class="border-t">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="py-4">
                            <a href="{{ route('reading_histories.create', $book->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">新規登録</a>
                        </div>
                        <table class="w-full">
                            <tr>
                                <th>読了日</th>
                                <th>評価</th>
                                <th>感想</th>
                                <th></th>
                            </tr>
                            @foreach ($book->readingHistories as $reading_history)
                            <tr>
                                <td>{{ $reading_history->display_finished_date }}</td>
                                <td>{{ $reading_history->evaluation }}</td>
                                <td>{{ $reading_history->thoughts }}</td>
                                <td>
                                <form method="post" action="{{ route('reading_histories.destroy', [$book->id, $reading_history->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('reading_histories.show', [$book->id, $reading_history->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">詳細</a>
                                    <a href="{{ route('reading_histories.edit', [$book->id, $reading_history->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">編集</a>
                                    <button type="submit" onClick="return clickDelete()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">削除</button>
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700">戻る</a>
            </div>
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
