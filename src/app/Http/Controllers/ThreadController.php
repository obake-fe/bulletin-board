<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThreadRequest;
use App\Models\Reply;
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
        $items = Thread::with('replies')
            ->authorPartialMatch($keyword)
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
     * 画像があれば、画像のパスをDBに保存する
     *
     * @param ThreadRequest $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(ThreadRequest $request): Redirector|RedirectResponse|Application
    {
        $form = $request->all();

        // thread_id（threadに紐づくid）の存在有無で、ThreadとReplyのどちらのModelと紐付けるか決める
        $thread = array_key_exists('thread_id', $form) ? new Reply() : new Thread();

        $image = $request->file('image');

        if (!is_null($image)) {
            $file_name = $image->getClientOriginalName();
            $form['image'] = $image->storeAs('public/images', $file_name);
        }

        // 認証済みユーザーの名前で保存する（ヘルパ関数authから認証済みユーザー名を取得）
        $form['author'] = auth()->user()->name;
        $form['author_id'] = auth()->user()->id;

        unset($form['_token']);
        $thread->fill($form)->save();
        return redirect('/');
    }

    /**
     * 編集画面に遷移させる
     *
     * 認証済みユーザー以外のユーザーが投稿したスレッドの編集ページにアクセスしようとした場合、
     * ルートにリダイレクトする
     *
     * @param int      $entry_id
     * @param int|null $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit(int $entry_id, int $id = null): View|Factory|Redirector|RedirectResponse|Application
    {
        // 指定されたidを持つレコードを取得する
        $thread = is_null($id) ? Thread::findOrFail($entry_id) : Reply::findOrFail($id);

        if ($thread['author_id'] !== auth()->user()->id) {
            return redirect('/');
        }

        return view('thread.edit', ['thread' => $thread]);
    }

    /**
     * 編集ページのPOSTボタン押下時の処理
     *
     * @param ThreadRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(ThreadRequest $request): Redirector|RedirectResponse|Application
    {
        $form = $request->all();
        $image = $request->file('image');

        if (!is_null($image)) {
            $file_name = $image->getClientOriginalName();
            $form['image'] = $image->storeAs('public/images', $file_name);
        }

        unset($form['_token']);

        // thread_id（threadに紐づくid）の存在有無で、ThreadとReplyのどちらのModelと紐付けるか決める
        $thread = array_key_exists('thread_id', $form) ? Reply::find($form['id']) : Thread::find($form['entry_id']);
        $thread->fill($form)->save();
        return redirect('/');
    }
}
