<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('up_count');
            $table->integer('down_count');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->unsignedInteger("thread_id")->nullable();
            $table->unsignedInteger("post_id")->nullable();
            $table->unsignedInteger("comment_id")->nullable();

            $table->foreign("thread_id")->references
            ("id")->on("threads")->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign("post_id")->references
            ("id")->on("posts")->onDelete('cascade')->onUpdate('cascade');

            $table->foreign("comment_id")->references
            ("id")->on("comments")->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
