<?php

namespace App\Http\Controllers;

use App\Models\Event;
use PDF;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function events()
    {
        $data = [
            'title' => 'Laporan Seluruh Event',
            'events' => Event::latest()->withCount('event_users')->get(),
        ];

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('print.events', $data)->setPaper('a4', 'landscape')->save('events.pdf');
        return $pdf->stream('events.pdf');
    }

    public function event($id)
    {
        $event = Event::findOrFail($id);
        $data = [
            'title' => 'Laporan Event',
            'event' => $event,
            'users' => $event->event_users,
        ];
        
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('print.event', $data)->setPaper('a4', 'landscape')->save('event-'.$event->slug.'.pdf');
        return $pdf->stream('event-'.$event->slug.'.pdf');
    }
}
