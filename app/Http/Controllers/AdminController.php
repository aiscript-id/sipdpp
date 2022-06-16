<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class AdminController extends Controller
{
    public function index()
    {
        // pluck event name
        $events = Event::select('id','name')->withCount('users')->get();
        // pluck events name
        $event_name = $events->pluck('name');
        // pluck user_count
        $user_count = $events->pluck('users_count');
        $data = [
            'event_name' => $event_name,
            'user_count' => $user_count,
        ];

        return view('admin.dashboard', compact('data'));
    }

    public function publish(Request $request)
    {
        $data = DB::table($request->table)->where('id', '=', $request->id);
        $data->update(['publish' => $request->publish]);
        // return response json message
        echo $request->publish;
    }
}
