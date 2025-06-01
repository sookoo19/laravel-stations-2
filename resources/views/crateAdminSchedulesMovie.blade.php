<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create schedules</title>
</head>
<body>
     <form action="/admin/movies/{{$movie->id}}/schedules/store" method="post">
         @method('POST') 
         @csrf
        <label for="start_time_date">開始日付:</label>
        <input type="date" id="start_time_date" required name="start_time_date" placeholder="YYYY-MM-DD">
        <br>
        <label for="start_time_time">開始時刻:</label>
        <input type="time" id="start_time_time" required name="start_time_time" placeholder="HH:ii">
        <br>
        <label for="end_time_date">終了日付:</label>
        <input type="date" id="end_time_date" required name="end_time_date" placeholder="YYYY-MM-DD">
        <br>
        <label for="end_time_time">終了時刻:</label>
        <input type="time" id="end_time_time" required name="end_time_time" placeholder="HH:ii">
        <br>
        <input type="submit" value="追加">
      
      
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