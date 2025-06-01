<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

      protected $fillable = [
        'name' // ジャンル名など、テーブルのカラムを指定
    ];

    public function movies()
    {
    return $this->hasMany(Movie::class);
    }
 
}