<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('flyers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('event_date');
            $table->string('event_time');
            $table->string('event_location');
            $table->string('organizer_name');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flyers');
    }
};
