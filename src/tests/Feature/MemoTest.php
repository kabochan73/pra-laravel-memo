<?php

namespace Tests\Feature;

use App\Models\Memo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemoTest extends TestCase
{
    use RefreshDatabase;

    public function test_メモ一覧が表示される(): void
    {
        $memo = Memo::create(['title' => 'テストメモ', 'body' => '本文です']);

        $response = $this->get(route('memos.index'));

        $response->assertStatus(200);
        $response->assertSee('テストメモ');
    }

    public function test_メモを作成できる(): void
    {
        $response = $this->post(route('memos.store'), [
            'title' => '新しいメモ',
            'body' => 'メモの本文',
        ]);

        $response->assertRedirect(route('memos.index'));
        $this->assertDatabaseHas('memos', ['title' => '新しいメモ']);
    }

    public function test_タイトルなしではメモを作成できない(): void
    {
        $response = $this->post(route('memos.store'), [
            'title' => '',
            'body' => '本文のみ',
        ]);

        $response->assertSessionHasErrors('title');
        $this->assertDatabaseCount('memos', 0);
    }

    public function test_メモの編集画面が表示される(): void
    {
        $memo = Memo::create(['title' => '編集テスト']);

        $response = $this->get(route('memos.edit', $memo));

        $response->assertStatus(200);
        $response->assertSee('編集テスト');
    }

    public function test_メモを更新できる(): void
    {
        $memo = Memo::create(['title' => '更新前', 'body' => '更新前本文']);

        $response = $this->put(route('memos.update', $memo), [
            'title' => '更新後',
            'body' => '更新後本文',
        ]);

        $response->assertRedirect(route('memos.index'));
        $this->assertDatabaseHas('memos', ['title' => '更新後']);
    }

    public function test_メモを削除できる(): void
    {
        $memo = Memo::create(['title' => '削除テスト']);

        $response = $this->delete(route('memos.destroy', $memo));

        $response->assertRedirect(route('memos.index'));
        $this->assertDatabaseMissing('memos', ['id' => $memo->id]);
    }

    public function test_メモを検索できる(): void
    {
        Memo::create(['title' => 'Laravel入門', 'body' => 'PHPフレームワーク']);
        Memo::create(['title' => 'React入門', 'body' => 'JSライブラリ']);

        $response = $this->get(route('memos.index', ['search' => 'Laravel']));

        $response->assertStatus(200);
        $response->assertSee('Laravel入門');
        $response->assertDontSee('React入門');
    }
}
