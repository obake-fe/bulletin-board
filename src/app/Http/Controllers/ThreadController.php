<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index()
    {
        $items = Thread::all();
        return view('thread.index', ['items' => $items]);
    }

    public function create(Request $request)
    {
        $thread = new Thread();
        $form = $request->all();
        unset($form['_token']);
        $thread->fill($form)->save();
        return redirect('/');
    }
}
