@extends('memos.layout')

@section('content')
    <div class="grid grid-cols-10 gap-6">
        <div class="col-span-3">
            {{-- メモ一覧表示機能 --}}
            @forelse ($memos as $memo)
                <div class="bg-white rounded-lg shadow mb-4 p-5 relative hover:bg-gray-50">
                    <a href="{{ route('memos.edit', $memo) }}" class="absolute inset-0 z-0"></a>
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold text-gray-800">{{ $memo->title }}</h2>
                            @if ($memo->body)
                                <p class="text-gray-600 mt-2 whitespace-pre-line">{{ Str::limit($memo->body, 200) }}</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm mt-2">{{ $memo->updated_at->format('Y/m/d H:i') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">メモがありません。</p>
            @endforelse
        </div>
        {{-- メモ作成機能 --}}
        <div class="col-span-7">
            <form action="{{ route('memos.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">タイトル
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full border border-gray-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="body" class="block text-gray-700 font-medium mb-2">本文</label>
                    <textarea name="body" id="body" rows="20"
                        class="w-full border border-gray-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('body') }}</textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">保存</button>
                    <a href="{{ route('memos.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded">キャンセル</a>
                </div>
            </form>
        </div>
    </div>
@endsection
