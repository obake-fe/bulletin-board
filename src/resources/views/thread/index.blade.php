<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bulletin Board</title>
</head>
<body>
    <h1>Bulletin Board</h1>
    <form action="/" method="post">
        @csrf
        <label for="author">name</label>
        <input type="text" name="author" id="author">
        <label for="message">text</label>
        <textarea name="message" id="message"></textarea>
        <button type="submit" name="operation" value="post">post</button>
    </form>
</body>
</html>
