<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Rules\MaxByteValidator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
     * バリデーションを実施して投稿を保存し、再度メインページを開く
     *
     * @param Request $request
     *
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function create(Request $request): Redirector|RedirectResponse|Application
    {
        $validator = Validator::make($request->all(), [
            'author' => ['required', 'max:20'],
            'message' => ['required', new MaxByteValidator(200)]
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $thread = new Thread();
        unset($validated['_token']);
        $thread->fill($validated)->save();
        return redirect('/');
    }
}
