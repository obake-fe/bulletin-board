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
     *
     * @param ReplyRequest $request
     * @return Redirector|RedirectResponse|Application
     */
    public function store(ReplyRequest $request): Redirector|RedirectResponse|Application
    {
        $reply = new Reply();
        $form = $request->all();
        unset($form['_token']);
        $reply->fill($form)->save();
        return redirect('/');
    }
}
