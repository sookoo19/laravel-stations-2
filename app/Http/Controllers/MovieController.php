<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Sheet;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function getMovie()
    {
        $movies = Movie::all();
        return view('getMovie', ['movies' => $movies]);
    }

    public function getAdminMovie()
    {
         $movies = Movie::paginate(20);
        return view('getAdminMovie', ['movies' => $movies]);
    }


    public function getAdminMovieStore()
    {
        return view('getAdminMovieStore');
    }


    public function storeAdminMovie(Request $request)
{
    // バリデーション例
    $validated = $request->validate([
        'title' => 'required|string|unique:movies,title',
        'genre' => 'required|string',
        'image_url' => 'required|url',
        'published_year' => 'required|integer',
        'description' => 'required|string',
        'is_showing' => 'required|boolean',
       
    ]);
     DB::transaction(function () use ($validated) {
        // ジャンルを取得または作成
        $genre = Genre::firstOrCreate(['name' => $validated['genre']]);

        
        // 映画を作成
        Movie::create([
            'title' => $validated['title'],
            'genre_id' => $genre->id, 
            'image_url' => $validated['image_url'],
            'published_year' => $validated['published_year'],
            'description' => $validated['description'],
            'is_showing' => $validated['is_showing'],
        ]);



        });

    return redirect('/admin/movies')->with('success', '映画が追加されました。');
}

 public function editAdminMovieStore($id)
    {
        $movie = Movie::findOrFail($id);
        return view('editAdminMovieStore', ['movie' => $movie]);
        
    }

    public function updateAdminMovieStore(Request $request, $id)
    {
        // バリデーション例
        $validated = $request->validate([
            'title' => 'required|string|unique:movies,title,' . $id,
           'genre' => 'required|string',
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'description' => 'required|string',
            'is_showing' => 'required|boolean',
           
        ]);

        DB::transaction(function () use ($validated, $id) {
        // ジャンルを取得または作成
        $genre = Genre::firstOrCreate(['name' => $validated['genre']]);

        // 映画を更新
        $movie = Movie::findOrFail($id);
        $movie->update([
            'title' => $validated['title'],
            'genre_id' => $genre->id,
            'image_url' => $validated['image_url'],
            'published_year' => $validated['published_year'],
            'description' => $validated['description'],
            'is_showing' => $validated['is_showing'],
        ]);
    });

        return redirect('/admin/movies')->with('success', '映画が更新されました。');
    }

    public function destroyAdminMovieStore(Request $request, $id)
    {
        $movie=Movie::findOrFail($id);
        $movie->delete();

        return redirect('/admin/movies')->with('success', '映画が削除されました。');
    }

    public function searchAdminMovieStore(Request $request)
    {
        $query = Movie::query();
        if ($request->filled('keyword')) {
        $keyword = $request->input('keyword');
        $query->where(function($q) use ($keyword) {
            $q->where('title', 'like', "%{$keyword}%")
              ->orWhere('description', 'like', "%{$keyword}%");
        });
    }

    if ($request->filled('is_showing')) {
        $query->where('is_showing', $request->input('is_showing'));
    }

        $movies = $query->paginate(20);

        return view('getAdminMovie', [
        'movies' => $movies
    ]);
}

public function sheetsAdminMovie()
    {
        // sheets テーブルの全データを取得
        $sheets = Sheet::all();

        return view('sheetsAdminMovie',['sheets' => $sheets]); ///compact('sheets')は ['sheets' => $sheets]
        
    }
    
public function schedulesMovie($id)
    {
        $movie = Movie::findOrFail($id);
       
       
         $schedules = Schedule::where('movie_id', $id)
        ->orderBy('start_time', 'asc') // 上映開始時刻の昇順で並び替え
        ->get(); // 複数のスケジュールを取得 


        return view('schedulesMovie',['movie'=> $movie, 'schedules'=> $schedules]);
    }
    
}