<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        /*$this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);*/

        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'member',
            'codename' => 'member',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'super_admin',
            'codename' => 'super-admin',
        ]);

        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'Andrej',
            'last_name' => 'Májik',
            'nickname' => '7aduso7',
            'role_id' => 2,
            'email' => 'a.majik7@gmail.com',
            'password' => bcrypt('password'),
        ]);


    }
}
