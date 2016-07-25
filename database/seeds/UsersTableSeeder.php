<?php

use Illuminate\Contracts\Hashing\Hasher;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'username' => "onion",
            'email' => "onionwyl@qq.com",
            'password' => Hash::make("onion"),
            'registration_time' = date('Y-m-d h:i:s'),
            'gid' = 0;
        ]);*/
        $user = new User;
        $user->username = "onion";
        $user->gid = 0;
        $user->registration_time = date('Y-m-d h:i:s');
        $user->password = Hash::make("onion");
        $user->email = "onionwyl@qq.com";
        $user->save();
    }
}
