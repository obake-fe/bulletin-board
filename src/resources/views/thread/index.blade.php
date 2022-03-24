@extends('layouts.base')

@section('title', 'Bulletin Board')

@section('content')
    <section class="mt-8 mx-[auto] p-4 border-2 rounded-md">
        <form action="/" method="post">
            @csrf
            <div>
                <div class="flex items-center mt-2">
                    <label for="author" class="w-12">name</label>
                    <input type="text" name="author" id="author" value="{{old('author')}}" class="border-2">
                </div>
                @error('author')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
            <div>
                <div class="flex items-center mt-2">
                    <label for="message" class="w-12">text</label>
                    <textarea name="message" id="message" class="border-2 w-full">{{old('message')}}</textarea>
                </div>
                @error('message')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
            <button type="submit" name="operation" value="post" class="mt-2 p-1 border-2 border-gray-700 rounded-md bg-gray-300">Post</button>
        </form>
    </section>
    <section class="mt-8">
        {{ $items->links('vendor.pagination.tailwind') }}
    </section>
    <section class="mt-2 p-4 border-2 rounded-md">
        <div class="">
            <form action="/" method="get" class="flex items-center">
                <label for="keyword">search</label>
                <input type="text" name="keyword" id="keyword" value="{{ $keyword }}" class="ml-2 border-2">
                <button type="submit" name="operation" value="get" class="ml-2 p-1 border-2 border-gray-700 rounded-md bg-gray-300">Search</button>
                <a href="/" class="ml-2 p-1 border-2 border-gray-700 rounded-md bg-gray-300">Reset</a>
            </form>
            @if(!empty($keyword))
                <p class="text-red-400">{{$items->total()}} data hit.</p>
            @endif
        </div>
        <div class="mt-2">
            @foreach($items as $item)
                <div class="first:mt-0 mt-4 p-4 border-2 border-gray-400">
                    <div class="mb-2">
                        <p>{{$item->post_date}}</p>
                        <p>{{$item->author}}</p>
                        <p>{{$item->message}}</p>
                    </div>
                    <hr>
                    <form action="/reply" method="post">
                        @csrf
                        <div>
                            <div class="flex items-center mt-2">
                                <label for="author" class="w-12">name</label>
                                <input type="text" name="author" id="author" value="{{old('author')}}" class="border-2">
                            </div>
                            @error('author')
                            <p class="text-red-500">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <div class="flex items-center mt-2">
                                <label for="message" class="w-12">text</label>
                                <textarea name="message" id="message" class="border-2 w-full">{{old('message')}}</textarea>
                            </div>
                            @error('message')
                            <p class="text-red-500">{{$message}}</p>
                            @enderror
                        </div>
                        <input type="hidden" name="thread_id" value="{{$item->entry_id}}">
                        <button type="submit" name="operation" value="post" class="mt-2 p-1 border-2 border-gray-700 rounded-md bg-gray-300">Reply</button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
    <section class="mt-2">
        {{ $items->links('vendor.pagination.tailwind') }}
    </section>
@endsection
