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
   *
   * threads tableに保存しているデータを取得し、スレッドとして表示する
   * ページングで10件ずつ表示
   *
   * @return Application|Factory|View
   */
    public function index(): View|Factory|Application
    {
        $items = Thread::paginate(10);
        return view('thread.index', ['items' => $items]);
    }

  /**
   * POSTボタン押下時の処理
   *
   * 投稿を保存し、再度メインページを開く
   *
   * @param Request $request
   *
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
