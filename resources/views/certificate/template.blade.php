<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
@include('layouts.includes.functions')
<style>
    body {
        /* certificate-01.jpg */
        /* background-image: url("{{ asset('assets/background/certificate-01.jpg') }}""); */
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>
<body style="background-image: url('{{ $image }}')">
    <div class="text-center p-5 mt-4">
        {{-- <h1>Sertifikat</h1> --}}
        {{-- <h3>{{ $event->name }}</h3> --}}
        <p class="text-white mb-3" style="font-size: 9pt; margin-top:155px;">No. Sertifikat : {{ $certificate->no_certificate }}</p>
        {{-- <p class="mt-5">diberikan kepada</p> --}}

        <p class="underline font-weight-bold" style="margin-top: 85px; font-size:20pt">{{ $user->name }}</p>
        <p style="font-size: 10pt;margin-top:80px">
            Atas partisipasinya pada event <b>{{ $event->name }}</b> yang dilaksanakan pada tanggal <br>
            {{ dateIndonesia($event->date) }}
            @if (@$event->end_date && $event->end_date != $event->date)
                - {{ dateIndonesia($event->end_date) }}
            @endif
        </p>

        <p class="mt-5">
            <img src="{{ $qrcode }}" alt="qrcode" style="width: 100px; height: 100px;">
        </p>
    </div>
  
  
</body>
</html>