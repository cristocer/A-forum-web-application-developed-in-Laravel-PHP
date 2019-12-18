<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('body');
            $table->string('slug')->unique;
            $table->string('image')->default('images/animal.jpg');
            $table->timestamps();
            $table->unsignedInteger("user_id");
            $table->integer("category_id")->unsigned();
            
            $table->foreign("user_id")->references
            ("id")->on("users")->onDelete('cascade')->onUpdate('cascade');

            $table->foreign("category_id")->references
            ("id")->on("categories")->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
