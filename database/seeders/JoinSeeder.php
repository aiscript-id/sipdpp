<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class JoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $events = Event::all();

        foreach ($events as $event) {
            // created at set this time         // updated at set this time
            $event->users()->attach($users->random(rand(1, $users->count()))->pluck('id')->toArray(),
                [
                    'created_at' => now(), 
                    'updated_at' => now()
                ]
            );
        }
    }
}
