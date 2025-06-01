<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All schedules</title>
</head>
<body>
    @if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
    @endif
    <h2>上映スケジュール</h2>
    <table border="2">
        <thead>
            <tr>
                <th>開始時刻</th>
                <th>終了時刻</th>
                <th>編集</th>
                <th>消去</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->start_time instanceof \Carbon\Carbon ? $schedule->start_time->format('Y-m-d H:i:s') : '未設定' }}</td>
                    <td>{{ $schedule->end_time instanceof \Carbon\Carbon ? $schedule->end_time->format('Y-m-d H:i:s') : '未設定' }}</td>
                    <td>
                        <a href="{{ url('/admin/schedules/' . $schedule->id . '/edit') }}">
                        <button type="button">編集</button>
                        </a>
                    </td>
                    
                    <td>
                        <form action="/admin/schedules/{{$schedule->id}}/destroy" method="post" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <td>
    <form action="/schedules/{{$movie->id}}/destroy" method="post" onsubmit="return confirm('本当に削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit">全削除</button>
    </form>
    </td>
    <a href="/admin/movies/{{$movie->id}}/schedules/create"> 
    <button type="button">追加</button>  
</body>