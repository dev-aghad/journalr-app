<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $p = new Post;
        $p->title = "Day 1 of my five mile run!";
        $p->body = "Decided that today was the day I would beat 20 minutes; my new record!";
        $p->user_id = 1;
        $p->save();

        $p = new Post;
        $p->title = "Day 2 of my five mile run!";
        $p->body= "I beat 18 minutes!";
        $p->user_id = 1;
        $p->save();

        $p = new Post;
        $p->title = "My experience with basketball";
        $p->body= "Went to play basketball for the first time.I usually play football so it was quite fun.";
        $p->user_id = 2;
        $p->save();

        $p = new Post;
        $p->title = "Getting better at basketball";
        $p->body = "I can finally dunk on my opponents now.";
        $p->user_id = 2;
        $p->save();
    }
}
