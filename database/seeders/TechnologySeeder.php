<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// models
use App\Models\Technology;


class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ["Front-End Dev.", "Back-End Dev.", "UX/UI Des."];

        foreach ($technologies as $item) {
            $newItem = new Technology();
            $newItem->name = $item;
            $newItem->slug = Technology::genSlug($newItem->name);

            $newItem->save();
        }
    }
}
