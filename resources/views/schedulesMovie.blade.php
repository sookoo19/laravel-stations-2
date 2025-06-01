<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>scheduleMovie</title>
</head>
<body>
    <table border="2">
    <thead>
        <tr>
            <td>映画詳細</td>
        </tr> 
    </thead>
    <tbody>
        <tr>
            <td>{{ $movie->title }}</td>
            <td>{{ $movie->genre ? $movie->genre->name : 'ジャンル未設定' }}</td> <!-- null チェックを追加 -->
            <td><img src="{{$movie->image_url}}" alt="写真"></td>
            <td>{{ $movie->published_year }}</td>
            <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
            <td>{{ $movie->description }}</td>
        </tr>
    </tbody>
</table>
   <h2>上映スケジュール</h2>
    <table border="2">
        <thead>
            <tr>
                <th>開始時刻</th>
                <th>終了時刻</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                      <td>{{ $schedule->start_time instanceof \Carbon\Carbon ? $schedule->start_time->format('H:i:s') : '未設定' }}</td>
            <td>{{ $schedule->end_time instanceof \Carbon\Carbon ? $schedule->end_time->format('H:i:s') : '未設定' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>