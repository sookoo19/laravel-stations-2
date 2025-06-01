<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->text('title')->comment('映画のタイトル');
            $table->text('image_url')->comment('画像URL');
            $table->integer('published_year')->comment('公開年')-> nullable(); // 追加
            $table->text('description')->comment('概要')-> nullable() ;         // 追加
            $table->tinyInteger('is_showing')->default(false)->comment('上映中かどうか'); // 追加
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
