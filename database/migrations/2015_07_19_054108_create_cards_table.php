<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('series_id')->unsigned()->index()->nullable();
            $table->string('layout');
            $table->string('type');
            $table->text('types');
            $table->text('colors')->nullable();
            $table->integer('multiverseid')->unsigned()->index();
            $table->string('name');
            $table->text('names')->nullable();
            $table->text('subtypes')->nullable();
            $table->integer('cmc')->unsigned()->nullable();
            $table->string('rarity');
            $table->string('artist');
            $table->string('power')->nullable();
            $table->string('toughness')->nullable();
            $table->string('manaCost')->nullable();
            $table->string('loyalty')->default(0);
            $table->text('text')->nullable();
            $table->text('flavor')->nullable();
            $table->string('number')->nullable();
            $table->string('imageName')->nullable();
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
        Schema::drop('cards');
    }
}
