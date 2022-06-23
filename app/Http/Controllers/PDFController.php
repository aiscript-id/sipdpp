<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function certificatePDF($id)
    {
        $certificate = Certificate::findOrFail($id);
        $data = [
            'event' => $certificate->event,
            'user' => $certificate->user,
            'certificate' => $certificate,
        ];
        $pdf = \PDF::loadView('certificate.template', $data);
        return $pdf->download('certificate-00'.$certificate->id.'-'.$certificate->user->name.'.pdf');
    }
}
