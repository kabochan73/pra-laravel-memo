@extends('memos.layout')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6 mx-6">詳細</h1>

    <form action="{{ route('memos.update', $memo) }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">タイトル <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title', $memo->title) }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="body" class="block text-gray-700 font-medium mb-2">本文</label>
            <textarea name="body" id="body" rows="20"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body', $memo->body) }}</textarea>
        </div>

        <div class="flex items-center">
            {{-- 削除ボタン（左寄せ） --}}
            <div>
                <button type="button" onclick="if(confirm('本当に削除しますか？')) document.getElementById('delete-form').submit()"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded">
                    削除
                </button>
            </div>
            {{-- 更新・キャンセル（右寄せ） --}}
            <div class="flex gap-3 ml-auto">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                    更新
                </button>
                <a href="{{ route('memos.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded">
                    キャンセル
                </a>
            </div>
        </div>
    </form>

    {{-- 削除用の隠しフォーム --}}
    <form id="delete-form" action="{{ route('memos.destroy', $memo) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endsection
