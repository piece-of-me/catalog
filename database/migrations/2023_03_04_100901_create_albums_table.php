<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('executor_id')->nullable();
            $table->index('executor_id', 'album_executor_idx');
            $table->foreign('executor_id', 'album_executor_jk')->on('executors')->references('id')->cascadeOnDelete();

            $table->year('year_of_issue');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
