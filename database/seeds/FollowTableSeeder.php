<?php

use Illuminate\Database\Seeder;

class FollowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty all previous records out
        \Illuminate\Support\Facades\DB::table('follow')->delete();

        \App\Models\Follow::create(array(
            'follower_id'      => 2,
            'followed_id'     => 1
        ));

    }
}
