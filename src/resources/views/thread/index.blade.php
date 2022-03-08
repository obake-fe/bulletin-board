<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>Bulletin Board</title>
</head>
<body class="mt-8 mx-[auto] w-[1024px]">
  <h1 class="text-2xl font-bold">Bulletin Board</h1>
  <section class="mt-8 mx-[auto] p-4 border-2 rounded-md">
    <form action="/" method="post">
      @csrf
      <div class="flex items-center mt-2">
        <label for="author" class="w-12">name</label>
        <input type="text" name="author" id="author" class="border-2">
      </div>
      <div class="flex items-center mt-2">
        <label for="message" class="w-12">text</label>
        <textarea name="message" id="message" class="border-2 w-full"></textarea>
      </div>
      <button type="submit" name="operation" value="post" class="mt-2 p-1 border-2 border-gray-700 rounded-md bg-gray-300">post</button>
    </form>
  </section>
  <section class="mt-8 p-4 border-2 rounded-md">
    @foreach($items as $item)
      <div class="first:mt-0 mt-4 p-4 border-2 border-gray-400">
        <p>{{$item->post_date}}</p>
        <p>{{$item->author}}</p>
        <p>{{$item->message}}</p>
      </div>
    @endforeach
  </section>
</body>
</html>
