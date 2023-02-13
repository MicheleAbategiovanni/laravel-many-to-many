<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ["HTML", "CSS", "VUE.JS", "PHP", "LARAVEL", "JS VANILLA", "SASS", "BOOTSTRAP", "MySQL"];

        foreach ($technologies as $technology) {
            Technology::create([
                "title" => $technology,
                "description" => "La Tecnologia usata è " . $technology
            ]);
        }
    }
}
