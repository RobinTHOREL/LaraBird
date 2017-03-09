<?php

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
        // Empty all previous records out
        \Illuminate\Support\Facades\DB::table('posts')->delete();

        for ($x = 1; $x <= 3; $x++) {
            for($y = 0; $y < 5; $y++) {

                $arrayText = [
                    "test",
                    "c'est bon",
                    "parfait",
                    "nickel",
                    "enfin"
                ];

                \App\Models\Post::create(array(
                    'post_content' => $arrayText[$y],
                    'author' => $x,
                ));

            }
        }

    }
}

