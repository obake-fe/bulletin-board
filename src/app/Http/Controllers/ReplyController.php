<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * 返信用
 */
class ReplyController extends Controller
{
    /**
     * Replyボタン押下時の処理
     *
     * 返信を保存し、再度メインページを開く
     * 画像があれば、画像のパスをDBに保存する
     *
     * @param ReplyRequest $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(ReplyRequest $request): Redirector|RedirectResponse|Application
    {
        $reply = new Reply();
        $form = $request->all();
        $image = $request->file('image');

        if (!is_null($image)) {
            $file_name = $image->getClientOriginalName();
            $form['image'] = $image->storeAs('public/images', $file_name);
        }

        // 認証済みユーザーの名前で保存する（ヘルパ関数authから認証済みユーザー名を取得）
        $form['author'] = auth()->user()->name;

        unset($form['_token']);
        $reply->fill($form)->save();
        return redirect('/');
    }
}
