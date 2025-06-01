<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All schedules</title>
</head>
<body>
     @foreach ($movies as $movie)
    <div>
    <h2>
        <a href="{{ url('/admin/movies/' . $movie->id) }}">
            {{$movie->id}} {{$movie->title}}
        </a>
    </h2>
    <h2>上映スケジュール</h2>
    <table border="2">
        <thead>
            <tr>
                <th>開始時刻</th>
                <th>終了時刻</th>
                <th>詳細リンク</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movie->schedules as $schedule)
                <tr>
                    <td>{{ $schedule->start_time instanceof \Carbon\Carbon ? $schedule->start_time->format('H:i:s') : '未設定' }}</td>
                    <td>{{ $schedule->end_time instanceof \Carbon\Carbon ? $schedule->end_time->format('H:i:s') : '未設定' }}</td>
                    <td><a href="{{ url('/admin/schedules/' . $schedule->id) }}">詳細を見る</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
     @endforeach
</body>