<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
             $table->string('title')->unique()->change(); // ユニーク制約を追加
            if (!Schema::hasColumn('movies', 'genre_id')) {
                $table->unsignedBigInteger('genre_id')->nullable()->after('title');
                $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
             Schema::table('movies', function (Blueprint $table) {
            $table->dropUnique(['title']);
            });
            // ジャンルIDの外部キー制約を削除
            if (Schema::hasColumn('movies', 'genre_id')) {
                $table->dropForeign(['genre_id']);
                $table->dropColumn('genre_id');
            }
        });
    }
};