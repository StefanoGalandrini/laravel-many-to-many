<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = Type::all();

        for ($i = 0; $i < 50; $i++) {
            $project = new Project;

            $project->type_id = $faker->randomElement($types)->id;
            $project->title = $faker->words(rand(2, 5), true);
            $project->url_image = 'https://picsum.photos/id/' . rand(1, 1080) . '/400/500';
            $project->description = $faker->paragraph(rand(2, 10), true);
            $project->creation_date = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d');
            $project->url_repo = 'https://github.com/StefanoGalandrini/' . $faker->lexify('???????-?????');

            $project->save();
        }
    }
}
