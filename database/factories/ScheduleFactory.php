<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition()
    {
        $startTime = Carbon::now()->setTime(
            $this->faker->numberBetween(0, 23), 
            $this->faker->numberBetween(0, 59), 
            0
        );
        $endTime = $startTime->copy()->addHours(2);


        return [
            'movie_id' => Movie::factory(),
            'start_time' => $startTime->format('Y-m-d H:i:s'),
            'end_time' => $endTime->format('Y-m-d H:i:s'),
        ];
    }
}