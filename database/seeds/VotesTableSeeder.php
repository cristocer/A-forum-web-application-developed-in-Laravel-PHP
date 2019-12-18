<?php
use App\Vote;
use Illuminate\Database\Seeder;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Vote::class, 50)->states('thread')->create();
        factory(App\Vote::class, 50)->states('post')->create();
        factory(App\Vote::class, 50)->states('comment')->create();
    }
}
