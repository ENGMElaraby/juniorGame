<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_letters', function (Blueprint $table) {
            $table->id();
            $table->string('letter', 191);
            $table->string('word', 191)->nullable();
            $table->string('image', 191)->nullable();
            $table->string('voice', 191)->nullable();
            $table->boolean('status');
            $table->bigInteger('letter_id', false, true);
            $table->foreign('letter_id')->references('id')->on('letters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_letters');
    }
}
