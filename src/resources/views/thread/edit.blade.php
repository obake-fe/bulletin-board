@extends('layouts.base')

@section('title', 'Bulletin Board')

@section('content')
    @error('message')
    <p class="mt-8 p-1 text-red-500 bg-red-300">Validation Error : {{$message}}</p>
    @enderror
    <section class="mt-8 mx-[auto] p-4 border-2 rounded-md">
        @php
            if ($thread->id) {
                // Reply用
                $action = ['id' => $thread->id, 'thread_id' => $thread->thread_id];
            } else {
                // Thread用
                $action = ['entry_id' => $thread->entry_id];
            }
        @endphp
        <form action="{{ route('update', $action) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div>
                <div class="flex items-center mt-2">
                    <label for="message" class="w-12">text</label>
                    <textarea name="message" id="message" class="border-2 w-full">@if(old('message')){{old('message')}}@else{{$thread->message}}@endif</textarea>
                </div>
            </div>
            <div class="mt-2">
                <input type="file" id="image" name="image">
            </div>
            <button type="submit" name="operation" value="post" class="mt-2 p-1 border-2 border-gray-700 rounded-md bg-gray-300">Post</button>
        </form>
    </section>
    <a href="/" class="inline-block mt-2 p-1 border-2 border-gray-700 rounded-md bg-gray-300">Top</a>
@endsection
