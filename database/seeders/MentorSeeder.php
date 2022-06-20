<?php

namespace Database\Seeders;

use App\Models\Mentor;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // faker indonesia
        $faker = \Faker\Factory::create('id_ID');
        // create 5 mentor from faker
        for ($i=0; $i < 5; $i++) { 
            Mentor::create([
                'name' => $faker->name,
                'image' => $faker->imageUrl(640, 480, 'people'),
                'description' => $faker->text(200),
            ]);
        }

    }
}
