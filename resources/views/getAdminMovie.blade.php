<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
  @if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
  @endif

    <form action='/movies' method="get">
    <label for='keyword'>キーワード検索:</label>
    <input type='text' id='keyword' name='keyword' placeholder='キーワードを入力してください' value="{{ request('keyword') }}">
    <div>
      <input type=radio  id="is_showing_all" name="is_showing" value="" {{request('is_showing','')=== '' ? 'checked' : '' }} >
      <label for="is_showing_all">すべて</label>
      <input type=radio  id="is_showing_1" name="is_showing" value="1" {{request('is_showing')=== '1' ? 'checked' : '' }}>
      <label for="is_showing_1">公開中</label>
      <input type=radio  id="is_showing_0" name="is_showing" value="0" {{request('is_showing')=== '0' ? 'checked' : '' }}>
    <label for="is_showing_0">公開予定</label>
    </div>
    <button type="submit">検索</button>
    </form>


    <table border="1">
        <thead>
          <tr>
            <th>映画タイトル</th>
            <th>ジャンル</th>
            <th>画像URL</th>
            <th>公開年</th>
            <th>上映中かどうか</th>
            <th>概要</th>
            <th>詳細</th>
            <th>編集</th>
            <th>消去</th>
          </tr> 
        </thead>
        <tbody>
            
             @foreach ($movies as $movie)
             <tr>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->genre ? $movie->genre->name : 'ジャンル未設定' }}</td> <!-- null チェックを追加 -->
                <td><img src="{{$movie->image_url}}" alt="写真"></td>
                <td>{{ $movie->published_year }}</td>
                <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
                <td>{{ $movie->description }}</td>
                <td>
                  <a href="/movies/{{ $movie->id }}">
                  <button type="button">詳細</button>
                  </a>
                </td>
                <td>
                  <a href="/admin/movies/{{ $movie->id }}/edit">
                  <button type="button">編集</button>
                  </a>
                </td>
                <td>
                  <form action="/admin/movies/{{ $movie->id }}/destroy" method="post" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                  </form>
                </td>
             </tr>
             @endforeach
         
        </tbody>
         
    </table>
    
    {{ $movies->appends(request()->query())->links() }}
    <a href ='/admin/movies/create'>登録画面へ</a>
</body>
</html>