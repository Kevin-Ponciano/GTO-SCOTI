<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->longText('comment');
            $table->dateTime('date_time_create');
            $table->boolean('private');
            $table->string('user_name')->nullable();

            $table->foreignId('user_id')->constrained();
            $table->foreignId('task_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
