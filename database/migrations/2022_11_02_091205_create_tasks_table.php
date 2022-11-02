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
            $table->string('description',255);
            $table->string('priority');
            $table->date('date_create');
            $table->date('deadline');
            $table->string('status');
            $table->string('situation');

//            $table->integer('company_id');
//            $table->foreign('company_id')->references('id')->on('companies');

            $table->foreignId('user_id')->index();
            $table->foreignId('team_id')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
