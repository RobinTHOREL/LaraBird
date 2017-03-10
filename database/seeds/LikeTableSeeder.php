<?php

use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty all previous records out
        \Illuminate\Support\Facades\DB::table('like')->delete();

        \App\Models\Like::create(array(
            'user_id'      => 2,
            'post_id'     => 1
        ));

    }
}
