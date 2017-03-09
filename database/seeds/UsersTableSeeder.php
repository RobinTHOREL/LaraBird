<?php

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

        // Empty all previous records out
        \Illuminate\Support\Facades\DB::table('users')->delete();

        for ($x = 0; $x <= 2; $x++) {
            $arrayName = [
                "Diego",
                "Robin",
                "Gael",
            ];

            $arrayEmail = [
                "Diego@gmail.com",
                "Robin@gmail.com",
                "Gael@gmail.com",
            ];

            \Illuminate\Foundation\Auth\User::create(array(
                'name'      => $arrayName[$x],
                'email'     => $arrayEmail[$x],
                'password'  => bcrypt('password12'),
            ));
        }

    }
}