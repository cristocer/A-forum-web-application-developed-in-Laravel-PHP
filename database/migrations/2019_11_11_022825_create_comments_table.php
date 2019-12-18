<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->timestamps();
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("post_id")->nullable();
            $table->unsignedInteger("thread_id")->nullable();

            $table->foreign("user_id")->references
            ("id")->on("users")->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign("post_id")->references
            ("id")->on("posts")->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign("thread_id")->references
            ("id")->on("threads")->onDelete('cascade')->onUpdate('cascade');
        });
    }
    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
