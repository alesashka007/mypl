<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->integer('status')->default(3);

            $table->integer('rate_id');
            $table->integer('user_id');

            $table->integer('port');
            $table->integer('slots');
            $table->time('time');

            $table->string('start_map');
            $table->string('start_slot');

            $table->boolean('ftp_status')->default(0);
            $table->boolean('fastdl_status')->default(0);
            $table->boolean('tv_status')->default(0);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
