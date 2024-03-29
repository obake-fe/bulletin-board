@extends('layouts.base')

@section('title', 'Bulletin Board')

@section('content')
    @error('message')
        <p class="mt-8 p-1 text-red-500 bg-red-300">Validation Error : {{$message}}</p>
    @enderror
    <section class="mt-8 mx-[auto] p-4 border-2 rounded-md">
        <form action="{{ route('root') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="flex items-center mt-2">
                    <label for="message" class="w-12">text</label>
                    <textarea name="message" id="message" class="border-2 w-full">{{old('message')}}</textarea>
                </div>
            </div>
            <div class="mt-2">
                <input type="file" id="image" name="image">
            </div>
            <button type="submit" name="operation" value="post" class="mt-2 p-1 border-2 border-gray-700 rounded-md bg-gray-300">Post</button>
        </form>
    </section>
    <section class="mt-8">
        {{ $items->links('vendor.pagination.tailwind') }}
    </section>
    <section class="mt-2 p-4 border-2 rounded-md">
        <div class="">
            <form action="{{ route('root') }}" method="get" class="flex items-center">
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
                    <div class="flex items-end mb-2">
                        <div class="w-full">
                            <p>{{$item->post_date}}</p>
                            <p>{{$item->author}}</p>
                            <p>{{$item->message}}</p>
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($item->image) }}" width="100px" alt="">
                        </div>
                        @if(Auth::user()->name === $item->author)
                            <a href="{{ route('edit', ['entry_id' => $item->entry_id]) }}" class="h-9 p-1 border-2 border-gray-700 rounded-md bg-gray-300">Edit</a>
                        @endif
                    </div>
                    @if(!is_null($item->replies))
                        @foreach($item->replies as $obj)
                            <hr>
                            <div class="flex items-end my-2">
                                <div class="w-full">
                                    <p>{{$obj->post_date}}</p>
                                    <p>{{$obj->author}}</p>
                                    <p>{{$obj->message}}</p>
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($obj->image) }}" width="100px" alt="">
                                </div>
                                @if(Auth::user()->name === $obj->author)
                                    <a href="{{ route('edit', ['entry_id' => $obj->thread_id, 'id' => $obj->id]) }}" class="h-9 p-1 border-2 border-gray-700 rounded-md bg-gray-300">Edit</a>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <hr>
                    <form action="{{ route('root') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div class="flex items-center mt-2">
                                <label for="message" class="w-12">text</label>
                                <textarea name="message" id="message" class="border-2 w-full">{{old('message')}}</textarea>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input type="file" id="image" name="image">
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
