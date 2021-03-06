<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\Sesi;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // show published event
        $user = User::findOrFail(auth()->user()->id);
        $events = $user->events()->latest()->paginate(10);
        // return response()->json($events);
        return view('user.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $event_user = EventUser::where('event_id', $event->id)->where('user_id', auth()->user()->id)->firstOrFail();
        $surveys = $event->surveys()->published()->get()->loadCount('fields');
        $sesis = $event->sesi;
        // return response()->json($surveys);
        return view('user.events.show', compact('event', 'surveys', 'sesis', 'event_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function join($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        // check if limit
        if($event->limit > 0 && $event->users()->count() >= $event->limit) {
            toastr()->error('Event is full.');
            return redirect()->route('user');
        }
        // check if user already joined
        if ($event->users()->where('user_id', auth()->id())->exists()) {
            toastr()->error('You already joined this event');
            return redirect()->back();
        } else {
            $event->users()->attach(auth()->id());
            toastr()->success('You joined this event successfully');
            // redirect to event page
        }
        return redirect()->route('user.events.show', $event->slug);
    }

    public function storeTugas(Request $request)
    {
        $sesi = Sesi::findOrFail($request->sesi_id);
        $nilai = $sesi->nilai()->where('user_id', auth()->id())->first();
        if ($nilai) {
            $nilai->update([
                'test' => $request->test,
            ]);
        } else {
            $sesi->nilai()->create([
                'user_id' => auth()->id(),
                'test' => $request->test
            ]);
        }
        toastr()->success('Your test has been submitted');
        return redirect()->back();
    }
}
