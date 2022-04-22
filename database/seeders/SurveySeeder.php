<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Survey 1',
            'slug' => 'survey-1',
            'description' => 'This is a survey',
            'created_at' => now(),
            'updated_at' => now()
        ];

        $survey = Survey::create($data);

        $survey->fields()->create([
            'question' => 'What is your name?',
            'type' => 'text',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $survey->fields()->create([
            'question' => 'What is your age?',
            'type' => 'number',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $survey->fields()->create([
            'question' => 'What is your hobby ?',
            'type' => 'text',
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
