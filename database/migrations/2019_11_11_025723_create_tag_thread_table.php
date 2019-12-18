<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagThreadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_thread', function (Blueprint $table) {
            $table->primary(['tag_id','thread_id']);
            $table->unsignedInteger('tag_id');
            $table->unsignedInteger('thread_id');

            $table->foreign("tag_id")->references
            ("id")->on("tags")->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign("thread_id")->references
            ("id")->on("threads")->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_thread');
    }
}
