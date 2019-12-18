<?php
use App\Thread;
use Illuminate\Database\Seeder;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Thread::class, 50)->create()->each(function ($thread){
            $a=App\Tag::inRandomOrder();
            $numbers = range(1, 100);
            shuffle($numbers);
            $tags = array($numbers[0],$numbers[1],$numbers[2]);            
            $thread->tags()->attach($tags);
            $thread->save();       
        }
        );
    }
}
