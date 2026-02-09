@extends('memos.layout')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">メモ一覧</h1>
        <a href="{{ route('memos.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            新規作成
        </a>
    </div>

    @forelse ($memos as $memo)
        <div class="bg-white rounded-lg shadow mb-4 p-5">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $memo->title }}</h2>
                    @if ($memo->body)
                        <p class="text-gray-600 mt-2 whitespace-pre-line">{{ Str::limit($memo->body, 200) }}</p>
                    @endif
                    <p class="text-gray-400 text-sm mt-2">{{ $memo->updated_at->format('Y/m/d H:i') }}</p>
                </div>
                <div class="flex gap-2 ml-4">
                    <a href="{{ route('memos.edit', $memo) }}" class="text-blue-500 hover:text-blue-700 text-sm">編集</a>
                    <form action="{{ route('memos.destroy', $memo) }}" method="POST" onsubmit="return confirm('削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">削除</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center py-8">メモがありません。</p>
    @endforelse
@endsection
