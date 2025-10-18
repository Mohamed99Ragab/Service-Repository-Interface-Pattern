<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->delete();
        DB::table('posts')->insert([
            [
                'title' => 'Post 1',
                'body' => 'Body 1',
                'user_id' => 1
            ],
            [
                'title' => 'Post 2',
                'body' => 'Body 2',
                'user_id' => 1
            ],
            [
                'title' => 'Post 3',
                'body' => 'Body 3',
                'user_id' => 1
            ]
        ]);
    }
}
