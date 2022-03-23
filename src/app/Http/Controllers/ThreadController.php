<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadRequest;
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
     * 検索単語がある場合は単語と部分一致するデータを取得する
     * ページングで10件ずつ表示する
     *
     * @param Request $request
     * @return View|Factory|Application
     */
    public function index(Request $request): View|Factory|Application
    {
        $keyword = $request->input('keyword');
        $items = Thread::authorPartialMatch($keyword)
            ->orWhere->messagePartialMatch($keyword)
            ->orderBy('entry_id', 'desc')
            ->paginate(10)
            ->appends($request->all());
        return view('thread.index', ['items' => $items, 'keyword' => $keyword]);
    }

    /**
     * POSTボタン押下時の処理
     *
     * 投稿を保存し、再度メインページを開く
     *
     * @param ThreadRequest $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(ThreadRequest $request): Redirector|RedirectResponse|Application
    {
        $thread = new Thread();
        $form = $request->all();
        unset($form['_token']);
        $thread->fill($form)->save();
        return redirect('/');
    }
}
