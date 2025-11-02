<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c = new Comment;
        $c->body = "Wow that's amazing! Love that.";
        $c->user_id = 1;
        $c->post_id = 1;
        $c->save();

        $c = new Comment;
        $c->body = "You are insane! How did you do that?";
        $c->user_id = 2;
        $c->post_id = 1;
        $c->save();

        $c = new Comment;
        $c->body = "Glad you got into it, keep going!";
        $c->user_id = 1;
        $c->post_id = 2;
        $c->save();

        $c = new Comment;
        $c->body = "Basketball is more fun than football.";
        $c->user_id = 2;
        $c->post_id = 2;
        $c->save();
    }
}
