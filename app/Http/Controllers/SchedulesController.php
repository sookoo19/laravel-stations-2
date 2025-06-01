<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Sheet;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

class SchedulesController extends Controller{

    public function adminAllschedulesMovie(){
    ///schedulesはMovieモデルのpublic function schedules()
        $movies = Movie::with(['schedules' => function ($query) {
        $query->orderBy('start_time', 'asc'); // schedules を start_time の昇順で並び替え
        }])
        ->has('schedules') // schedules を持つ映画のみ取得
        ->get();
            
        return view('adminAllschedulesMovie', compact('movies'));
    }
    
    public function adminScheduleDetail($id){
        $movie = Movie::findOrFail($id);
        $schedules = Schedule::where('movie_id', $id)->orderBy('start_time', 'asc')->get(); // 映画 ID に基づいてスケジュールを取得
        return view('adminScheduleDetail', compact('schedules','movie')); // 詳細ページにデータを渡す
    }

    public function crateAdminSchedulesMovie($id){
        $movie = Movie::findOrFail($id);
        return view('crateAdminSchedulesMovie', compact('movie'));
    
    }

    public function storeAdminSchedulesMovie(Request $request, $id){
         $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id', // movie_id のバリデーションを追加
            'start_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d',
            'end_time_time' => 'required|date_format:H:i',
         ]);
         $movie = Movie::findOrFail($id);
         
         // スケジュールを保存する処理
         Schedule::create([
        'movie_id' => $movie->id,
        'start_time' => Carbon::createFromFormat('Y-m-d H:i', $validated['start_time_date'] . ' ' . $validated['start_time_time'])->format('Y-m-d H:i:s'), // 日付と時間を結合
        'end_time' => Carbon::createFromFormat('Y-m-d H:i', $validated['end_time_date'] . ' ' . $validated['end_time_time'])->format('Y-m-d H:i:s'), // 日付と時間を結合
    ]);

         return redirect('/admin/schedules/'.$movie->id)->with('success', 'スケジュールが追加されました。');

    }

    public function editAdminSchedulesMovie($scheduleId){
        $schedule = Schedule::findOrFail($scheduleId);
        $movie = Movie::findOrFail($schedule->movie_id);
        return view('editAdminSchedulesMovie', compact('movie', 'schedule'));
    }

    public function updateAdminSchedulesMovie(Request $request, $scheduleId){

        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id', // movie_id のバリデーションを追加
            'start_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d',
            'end_time_time' => 'required|date_format:H:i'
         ]);
        $schedule = Schedule::findOrFail($scheduleId); 
        
         // スケジュールを保存する処理
        $schedule -> update([
        'movie_id' => $validated['movie_id'],
        'start_time' => Carbon::createFromFormat('Y-m-d H:i', $validated['start_time_date'] . ' ' . $validated['start_time_time'])->format('Y-m-d H:i:s'), // 日付と時間を結合
        'end_time' => Carbon::createFromFormat('Y-m-d H:i', $validated['end_time_date'] . ' ' . $validated['end_time_time'])->format('Y-m-d H:i:s'), // 日付と時間を結合
        ]);
        return redirect('/admin/schedules/'.$schedule->movie_id)->with('success', 'スケジュールが更新されました。');
    }

    public function destroySchedulesMovie(Request $request, $id)
    {
        $movie=Movie::findOrFail($id);
        $schedules = Schedule::where('movie_id', $id)->delete(); // 映画 ID に基づいてスケジュールを取得
       

        return redirect('/admin/schedules/'.$movie->id)->with('success', '全スケジュールが削除されました。');
    }

     public function destroyAdminSchedulesMovie(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id); // スケジュール ID に基づいてスケジュールを取得
        $schedule->delete(); // スケジュールを削除

        return redirect()->back()->with('success', '指定されたスケジュールが削除されました。');
    }
    

    public function showMovie($id)
    {
    $movie = Movie::with(['schedules' => function ($query) {
    $query->orderBy('start_time', 'asc'); // schedules を start_time の昇順で並び替え
    }])->findOrFail($id);
    return view('showMovie', compact('movie')); // 詳細ページにデータを渡す
    }
}