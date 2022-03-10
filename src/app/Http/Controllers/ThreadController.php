<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * 掲示板
 */
class ThreadController extends Controller
{
  /**
   * メインページ表示用
   * @return Application|Factory|View
   */
    public function index(): View|Factory|Application
    {
        $items = Thread::all();
        return view('thread.index', ['items' => $items]);
    }

  /**
   * 投稿のPOST時に呼ばれる
   * 投稿を保存し再度ページを開く
   * @param Request $request
   * @return Application|RedirectResponse|Redirector
   */
    public function create(Request $request): Redirector|RedirectResponse|Application
    {
        $thread = new Thread();
        $form = $request->all();
        unset($form['_token']);
        $thread->fill($form)->save();
        return redirect('/');
    }
}
