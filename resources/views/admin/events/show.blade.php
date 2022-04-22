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
      </div>
   </div>

   {{-- peserta --}}
   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h4 class="card-title">Peserta</h4>
         </div>
         @if ($event->users_count > 0)
            <div class="table-responsive mb-2">
               <table class="table table-sm table-striped">
                  <thead>
                     <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($users as $user)    
                     <tr>
                        <td class="py-1">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                           {{-- peserta --}}
                           <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-inverse-warning">
                              <i class="mdi mdi-eye"></i>
                           </a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            {{ $users->links() }}
         @else
            <p class="card-description">
               Tidak ada peserta
            </p>
         @endif
      </div>
   </div>
   
@endsection