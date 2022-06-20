@extends('layouts.admin')
@section('content')
   <div class="card mb-3">
      <div class="card-body">
         <div class="d-flex justify-content-between mb-4">
            <h4 class="card-title">{{ $event->name }}</h4>
            <a href="{{ route('events.index') }}">
               <button class="btn btn-inverse-secondary btn-sm">
                  {{-- <i class="mdi mdi-chevron-left"></i> --}}
                  Kembali
               </button>
            </a>
         </div>
         <div class="row">
            <div class="col-md-3">
               <p class="card-description text-primary">
                  <i class="mdi mdi-calendar"></i>
                  {{ $event->getDate }}
               </p>
            </div>
            {{-- time --}}
            <div class="col-md-3">
               <p class="card-description text-primary">
                  <i class="mdi mdi-clock"></i>
                  {{ $event->getTime }}
               </p>
            </div>
            <div class="col-md-6">
               <p class="card-description text-primary">
                  <i class="mdi mdi-map-marker"></i>
                  {{ $event->location ?? '-' }}
               </p>
            </div>
         </div>
         <p class="card-description">
            {{ $event->description }}
         </p>

         <div class="mt-4">
            <a href="{{ route('events.show', $event->id) }}" 
                class="btn btn-sm btn-{{ Request::routeIs('events.show*') ? '' : 'inverse-' }}success" title="Sesi">
                <i class="mdi mdi-bulletin-board"></i> Sesi
            </a>
            <a href="{{ route('events.peserta', $event->id) }}" 
                class="btn btn-sm btn-{{ Request::routeIs('events.peserta*') ? '' : 'inverse-' }}warning" title="Peserta">
                <i class="mdi mdi-account"></i> Peserta
            </a>
            <a href="{{ route('events.surveys', $event->id) }}" 
                class="btn btn-sm btn-{{ Request::routeIs('events.surveys*') ? '' : 'inverse-' }}primary" title="Survey">
                <i class="mdi mdi-clipboard-text"></i> Survey
            </a>
         </div>
      </div>
   </div>

   {{-- tab bar --}}
   {{-- <ul class="nav nav-pills p-0 mb-3 " style="border-bottom:none" id="pills-tab" role="tablist">
       <li class="nav-item" role="presentation">
         <a href="{{ route('events.show', $event->id) }}" class="nav-link active">Detail</a>
       </li>
       <li class="nav-item" role="presentation">
         <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
       </li>
       <li class="nav-item" role="presentation">
         <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
       </li>
   </ul> --}}

    


    @yield('sub-content')
   
@endsection