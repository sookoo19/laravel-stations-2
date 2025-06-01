<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit schedules</title>
</head>
<body>
     <form action="/admin/schedules/{{$schedule->id}}/update" method="post">
        
         @csrf
        @method('PATCH') 
        
        <input type="hidden" name="movie_id" value="{{old('movie_id' ,$schedule->movie_id )}}">
        <label for="start_time_date">開始日付:</label>
        <input type="date" id="start_time_date" required name="start_time_date" placeholder="YYYY-MM-DD" value="{{ old('start_time_date', $schedule->start_time ? $schedule->start_time->format('Y-m-d') : '') }}">
        <br>
        <label for="start_time_time">開始時刻:</label>
        <input type="time" id="start_time_time" required name="start_time_time" placeholder="HH:ii" value="{{ old('start_time_time', $schedule->start_time ? $schedule->start_time->format('H:i') : '') }}">
        <br>
        <label for="end_time_date">終了日付:</label>
        <input type="date" id="end_time_date" required name="end_time_date" placeholder="YYYY-MM-DD" value="{{ old('end_time_date', $schedule->end_time ? $schedule->end_time->format('Y-m-d') : '') }}">
        <br>
        <label for="end_time_time">終了時刻:</label>
        <input type="time" id="end_time_time" required name="end_time_time" placeholder="HH:ii" value="{{ old('end_time_time', $schedule->end_time ? $schedule->end_time->format('H:i') : '') }}">
        <br>
        <input type="submit" value="更新">
        
      
      
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