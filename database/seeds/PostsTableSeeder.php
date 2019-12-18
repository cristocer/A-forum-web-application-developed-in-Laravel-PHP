<?php
use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 50)->create()->each(function ($post){
            $a=App\Tag::inRandomOrder();
            $numbers = range(1, 100);
            shuffle($numbers);
            $tags = array($numbers[0],$numbers[1],$numbers[2]);            
            $post->tags()->attach($tags);
            $post->save();       
        }
        );
    }
}
