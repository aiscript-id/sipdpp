<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CertificateController extends Controller
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
        $event_user = EventUser::findOrFail($request->event_user_id);
        $event = $event_user->event;
        $name = "Sertifikat ". $event->name;
        $no_certificate = '0000' . $event_user->id . '-' . $event->id . '-' . $event_user->user->id . '-' . date('Ymd', strtotime($event->end_date));
        $certificate = $event_user->certificate()->create([
            'user_id' => $event_user->user_id,
            'event_id' => $event_user->event_id,
            'event_user_id' => $event_user->id,
            'name' => $name,
            'no_certificate' => $no_certificate,
            'status' => 'approved', 
            'terbit' => date('Y-m-d'),
        ]);

        // $this->createQrCode($certificate);

        // return to eventpeserta
        toastr()->success('Sertifikat untuk '. $event_user->user->name .' berhasil dibuat');
        return redirect()->route('events.peserta', $event->id);

    }

    public function createQrCode($certificate)
    {
        // create qrcode
        $qrcode = \QrCode::format('png')->size(200)->generate($certificate->no_certificate);
        $qrcode_path = public_path('qrcodes/' . $certificate->no_certificate . '.png');
        $qrcode_url = asset('qrcodes/' . $certificate->no_certificate . '.png');
        file_put_contents($qrcode_path, $qrcode);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // certificatePDF
        $certificate = Certificate::findOrFail($id);
        $event = $certificate->event;
        $event_user = $certificate->event_user;
        $data = [
            'event' => $event,
            'user' => $event_user->user,
            'certificate' => $certificate,
            'image' => public_path() . '/assets/background/certificate-01.jpg',
            'qrcode' => '',
        ];
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('certificate.template', $data)->setPaper('a4', 'landscape')->save('certificate.pdf');
        return $pdf->stream('certificate.pdf');
        // return $pdf->download('certificate-00'.$certificate->id.'-'.$certificate->user->name.'.pdf');
        // store avatar to storage
        // $path = $pdf->save(storage_path('certificate/certificate-00'.$certificate->id.'-'.$certificate->user->name.'.pdf'));
        // $certificate->update([
        //     'file' => $path,
        // ]);
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
}
