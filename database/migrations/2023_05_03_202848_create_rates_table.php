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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->boolean('status')->default(1);
            $table->decimal('price', 8, 2);
            $table->integer('min_s');
            $table->integer('max_s');
            $table->foreignId('game_id')
                ->references('id')
                ->on('games');
            $table->foreignId('vds_id')
                ->references('id')
                ->on('vds');
            $table->integer('quota');
            $table->integer('tick');
            $table->boolean('tv');
            $table->boolean('ftp');
            $table->boolean('fastdl');
            $table->boolean('addons');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
