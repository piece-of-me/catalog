<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('album_id')->nullable();
            $table->index('album_id', 'song_album_idx');
            $table->foreign('album_id', 'song_album_fk')->on('albums')->references('id');

            $table->string('name');
            $table->unsignedSmallInteger('order_number_in_album');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
