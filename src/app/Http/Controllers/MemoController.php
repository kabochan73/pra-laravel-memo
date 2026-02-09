<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index()
    {
        $memos = Memo::latest()->get();
        return view('memos.index', compact('memos'));
    }

    public function create()
    {
        return view('memos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Memo::create($request->only('title', 'body'));

        return redirect()->route('memos.index')->with('success', 'メモを作成しました。');
    }

    public function edit(Memo $memo)
    {
        return view('memos.edit', compact('memo'));
    }

    public function update(Request $request, Memo $memo)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $memo->update($request->only('title', 'body'));

        return redirect()->route('memos.index')->with('success', 'メモを更新しました。');
    }

    public function destroy(Memo $memo)
    {
        $memo->delete();

        return redirect()->route('memos.index')->with('success', 'メモを削除しました。');
    }
}
