<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagNames = [
            'game',
            'allegriout',
            '2022',
            'gadget',
            'food',
            'drink',
            'enjoy',
            'discover',
            'inspiration',
        ];

        foreach ($tagNames as $tagName) {
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        }
    }
}
