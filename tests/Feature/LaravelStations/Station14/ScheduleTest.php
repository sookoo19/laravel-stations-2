<?php

namespace Tests\Feature\LaravelStations\Station14;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Schedule;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    #[Group('station14')]
    public function test映画詳細ページが表示される(): void
    {
        $movie = $this->createMovie();
        $response = $this->get('/movies/' . $movie->id);
        $response->assertStatus(200);
        $response->assertSeeText($movie->title);
        $response->assertSee($movie->image_url);
        $response->assertSeeText($movie->published_year);
        $response->assertSeeText($movie->description);
    }

    #[Test]
    #[Group('station14')]
    public function test映画スケジュールのリレーションが存在する(): void
    {
        $movie = $this->createMovie();
        $this->createSchedule($movie->id);

        $movie = Movie::with('schedules')->find($movie->id);
        $this->assertCount(10, $movie->schedules);
    }

    #[Test]
    #[Group('station14')]
    public function test映画詳細ページに紐づくスケジュールが表示される(): void
    {
        $movie = $this->createMovie();
        $this->createSchedule($movie->id);
        $movie = Movie::with('schedules')->find($movie->id);

        $response = $this->get('/movies/' . $movie->id);
        $response->assertStatus(200);

        foreach ($movie->schedules as $schedule) {
            $response->assertSeeText($schedule->start_time->format('H:i'));
            $response->assertSeeText($schedule->end_time->format('H:i'));
        }
    }

    #[Test]
    #[Group('station14')]
    public function test上映スケジュールが上映開始時刻の昇順である(): void
    {
        $movieId = $this->createMovie()->id;
        $schedule1 = Schedule::create([
    'movie_id' => $movieId,
    'start_time' => '20:00:00', // 文字列で保存
    'end_time' => '21:00:00',
]);

$schedule2 = Schedule::create([
    'movie_id' => $movieId,
    'start_time' => '10:00:00',
    'end_time' => '11:00:00',
]);

$schedule3 = Schedule::create([
    'movie_id' => $movieId,
    'start_time' => '13:00:00',
    'end_time' => '14:00:00',
]);

        $response = $this->get('/movies/' . $movieId);
        $response->assertSeeTextInOrder([
            $schedule2->start_time->format('H:i'),
            $schedule3->start_time->format('H:i'),
            $schedule1->start_time->format('H:i'),
        ]);
    }

    private function createMovie(): Movie
    {
        $genreId = Genre::insertGetId(['name' => 'ジャンル']);
        $movieId = Movie::insertGetId([
            'title' => '最初からある映画',
            'image_url' => 'https://techbowl.co.jp/_nuxt/img/6074f79.png',
            'published_year' => 2000,
            'description' => '概要',
            'is_showing' => false,
            'genre_id' => $genreId,
        ]);
        return Movie::find($movieId);
    }

    private function createSchedule(int $movieId): void
    {
        $count = 10;
        for ($i = 0; $i < $count; $i++) {
            Schedule::insert([
                'movie_id' => $movieId,
                'start_time' => CarbonImmutable::createFromTime($i, 0, 0),
                'end_time' => CarbonImmutable::createFromTime($i + 2, 0, 0),
            ]);
        }
    }
}
