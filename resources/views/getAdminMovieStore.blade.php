<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AdminMovieStore</title>
</head>
<body>
    <form action="/admin/movies/store" method="post">
        <label for="title">映画タイトル:</label>
        <input type="text" id="title" required name="title" placeholder="映画タイトルを入力してください">
        <br>
        <label for="genre">ジャンル:</label>
        <input type="text" id="genre" required name="genre" placeholder="ジャンルを入力してください">
        <br>
        <label for="image_url">画像URL:</label>
        <input type="text" id="image_url" required name="image_url" placeholder="画像のURLを入力してください">
        <br>
        <label for="published_year">公開年:</label>
        <input type="integer" id="published_year" required name="published_year" placeholder="公開年を入力してください"  min="1000"
    max="9999">
        <br>
        <label>公開中かどうか:</label>
        <input type="radio" id="is_showing_1" name="is_showing" value="1" >
        <label for="is_showing_1">上映中</label>
        <input type="radio" id="is_showing_0" name="is_showing" value="0">
        <label for="is_showing_0">上映予定</label>
        <br>
        <label for="description">概要:</label>
        <textarea id="text" required name="description" placeholder="映画の概要を入力してください"></textarea>
        <br>
        <input type="submit" value="登録">
        @csrf
      
        @if ($errors->any())
        <div style="color: red;">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        
        
    </form>
</body>
</html>