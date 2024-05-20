<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag1 = new Tag();
        $tag1->priority = "low";
        $tag1->save();

        $tag2 = new Tag();
        $tag2->priority = "high";
        $tag2->save();

        $tag2 = new Tag();
        $tag2->priority = "medium";
        $tag2->save();

    }
}
