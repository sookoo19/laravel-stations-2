<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'movie_id',
        'start_time',
        'end_time',
    ];
 // Movie リレーションを定義
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id'); // movie_id を外部キーとして関連付け
    }
     // start_time を Carbon オブジェクトに変換
    public function getStartTimeAttribute($value)
{
      return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value) : null;
}

public function getEndTimeAttribute($value)
{
       return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value) : null;
}
}
