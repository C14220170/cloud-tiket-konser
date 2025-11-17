<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start_at');
            $table->string('venue');
            $table->string('image')->nullable();
            $table->integer('min_price')->default(0);
            $table->integer('max_price')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('events');
    }
};