<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $t = new Tag;
        $t->name = "Work";
        $t->save();
        $t->posts()->attach(1);

        $t = new Tag;
        $t->name = "Videogames";
        $t->save();
        $t->posts()->attach(1);

        $t = new Tag;
        $t->name = "Sports";
        $t->save();
        $t->posts()->attach([1,2]);

        $t = new Tag;
        $t->name = "Academic";
        $t->save();
        $t->posts()->attach(2);
    }
}
