<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $p = new Profile;
        $p->bio = "Hello my name is Alice and I like volleyball!";
        $p->profile_picture = "avatar1.png";
        $p->user_id = 1;
        $p->save();

        $p = new Profile;
        $p->bio = "Hello my name is Bob and I like football!";
        $p->profile_picture = "avatar2.png";
        $p->user_id = 2;
        $p->save();
    }
}
