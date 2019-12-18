<?php
use App\FacebookAccount;
use Illuminate\Database\Seeder;

class FacebookAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\FacebookAccount::class, 8)->create();
    }
}
