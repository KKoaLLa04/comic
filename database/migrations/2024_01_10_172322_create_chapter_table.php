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
        Schema::create('chapter', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title', 200);
            $table->string('slug');
            $table->text('description');
            $table->text('content');
            $table->tinyInteger('status');
            $table->integer('comic_id');
            $table->foreign('comic_id')->references('id')->on('comic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapter');
    }
};
