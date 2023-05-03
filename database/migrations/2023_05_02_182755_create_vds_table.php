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
        Schema::create('vds', function (Blueprint $table) {
            $table->id();

            $table->foreignId('location_id');
            $table->boolean('status')->default(1);
            $table->string('cores');
            $table->ipAddress('ip')->unique();
            $table->string('port')->default(22);
            $table->string('login');
            $table->string('password');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vds');
    }
};
