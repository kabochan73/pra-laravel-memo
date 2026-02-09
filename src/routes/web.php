<?php

use App\Http\Controllers\MemoController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('memos.index'));

Route::resource('memos', MemoController::class)->except(['show']);
