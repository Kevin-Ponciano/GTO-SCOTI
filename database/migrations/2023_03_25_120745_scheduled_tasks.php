<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scheduled_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('recorrence_count');
            $table->enum('frequency', ['day', 'week', 'month', 'year']);
            $table->date('date');
            $table->time('hour');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheduled_tasks');
    }
};

