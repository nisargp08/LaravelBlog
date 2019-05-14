<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //DB::table('users')->truncate();
        //DB::table('posts')->truncate();

        /*Calling users factory*/
        factory(App\User::class,2)->create()->each(function($user){
            $user->post()->save(factory(App\Post::class)->make());
        });

    }
}
