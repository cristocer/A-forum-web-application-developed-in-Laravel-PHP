<?php
use App\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Comment::class, 30)->states('thread')->create();
        factory(App\Comment::class, 30)->states('post')->create();
    }
}
