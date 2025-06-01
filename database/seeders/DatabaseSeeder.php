<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 映画を40件生成
        $movies = Movie::factory(40)->create();

        // 他の Seeder を呼び出す
        $this->call([
            SheetSeeder::class, // SheetSeeder を追加
        ]);

        // 各映画にスケジュールを生成
        foreach ($movies as $movie) {
            Schedule::factory()->count(3)->create([
                'movie_id' => $movie->id, // movie_id を関連付け
            ]);
        }
    }
}