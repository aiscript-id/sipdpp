<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Mentor;
use App\Models\Nilai;
use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $event = Event::findOrFail($id);
        $url = route('events.sesi.store', ['event_id' => $event->id]);
        $mentors = Mentor::all();
        return view('admin.events.sesi.form', compact('event', 'url', 'mentors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $event = Event::find($request->event_id);  
        $data = $request->validate([
            'mentor_id' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'type' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        $data['slug'] = \Str::slug($data['name']);

        $event->sesi()->create($data);

        toastr()->success('Session created successfully.');
        return redirect()->route('events.show', $event->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($event, $sesi)
    {
        $event = Event::findOrFail($event);
        $sesi = Sesi::findOrFail($sesi);
        // return response()->json(['event' => $event, 'sesi' => $sesi]);
        $url = route('events.sesi.update', ['id' => $sesi->id]);
        $mentors = Mentor::all();

        return view('admin.events.sesi.form', compact('event', 'sesi', 'url', 'mentors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sesi = Sesi::findOrFail($request->id);
        $data = $request->validate([
            'mentor_id' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        $data['slug'] = \Str::slug($data['name']);

        $sesi->update($data);

        toastr()->success('Session updated successfully.');
        return redirect()->route('events.show', $sesi->event->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sesi = Sesi::findOrFail($id);
        $sesi->delete();
        toastr()->success('Session deleted successfully.');
        return redirect()->route('events.show', $sesi->event->id);
    }

    public function nilai($id)
    {
        $sesi = Sesi::findOrFail($id);
        $event = $sesi->event;
        $nilais = Nilai::where('sesi_id', $id)->paginate(10);
        return view('admin.events.sesi.nilai', compact('sesi', 'nilais', 'event'));
    }

    public function nilaiUpdate(Request $request)
    {
        $nilai = Nilai::findOrFail($request->nilai_id);
        $data = $request->validate([
            'nilai' => 'required',
        ]);

        $nilai->update($data);

        toastr()->success('Nilai updated successfully.');
        return redirect()->route('events.tugas.nilai', $nilai->sesi->id);
    }
}
