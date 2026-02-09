@extends('memos.layout')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">メモ作成</h1>

    <form action="{{ route('memos.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">タイトル <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="body" class="block text-gray-700 font-medium mb-2">本文</label>
            <textarea name="body" id="body" rows="6"
                      class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body') }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">保存</button>
            <a href="{{ route('memos.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded">キャンセル</a>
        </div>
    </form>
@endsection
