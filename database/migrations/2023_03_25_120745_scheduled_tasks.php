<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scheduled_tasks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('hour');
            $table->integer('recorrence_count')->default(1);
            $table->enum('frequency', ['day', 'week', 'month', 'year'])->default('day');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheduled_tasks');
    }
};

