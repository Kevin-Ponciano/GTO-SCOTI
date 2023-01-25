<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('priority');
            $table->date('date_create');
            $table->date('deadline');
            $table->string('status')->nullable();
            $table->string('situation');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('team_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
