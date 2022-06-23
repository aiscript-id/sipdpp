@extends('admin.events.head')
@include('layouts.includes.functions')
@section('sub-content')
   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h4 class="card-title">Peserta</h4>
         </div>
         <small><b>catatan :</b> klik nama tugas untuk mengisi nilai peserta pada tugas yang dipilih</small>
         @if ($event->users_count > 0)
            <div class="table-responsive mb-2">
               <table class="table table-striped ">
                  <thead class="">
                     <tr>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Email</th>
                        <th class="text-center" colspan="{{ $event->sesi()->where('type', 'tugas')->count() }}">Tugas</th>
                        <th rowspan="2">Sertifikat</th>
                        <th rowspan="2">Aksi</th>
                     </tr>
                     <tr>
                        {{-- sesi tugas --}}
                        @foreach ($event->sesi()->where('type', 'tugas')->get() as $sesi)
                           <th class="text-center">
                              <a name="" id="" class="btn btn-sm btn-link text-decoration-none" href="{{ route('events.tugas.nilai', ['sesi' => $sesi->id]) }}" role="button">
                                 {{ $sesi->name }}
                              </a>
                           </th>
                        @endforeach
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($users as $user)    
                     <tr>
                        <td class="py-1">{{ $user->user->name }}</td>
                        <td>{{ $user->user->email }}</td>
                        @foreach ($event->sesi()->where('type', 'tugas')->get() as $sesi)
                           <td class="text-center">
                              @php
                                  $tugas = @$sesi->myTugas($user->user->id);
                              @endphp
                              @if (@$tugas)
                                 <span class="text-{{ ($tugas->nilai == 0) ? 'warning' : 'success'  }}">
                                    <i class="mdi mdi-{{ ($tugas->nilai == 0) ? 'information' : 'check-circle'  }}"></i>
                                    {{ $tugas->nilai ?? 0 }}
                                 </span>
                              @else 
                                 <span class="text-danger">
                                    <i class="mdi mdi-close-circle"></i>
                                 </span>
                              @endif
                           </td>
                        @endforeach
                        <td>
                           @if (@$user->certificate)
                              <a href="{{ route('events.certificates.show', $user->certificate->id) }}" class="btn btn-inverse-success btn-sm" target="_blank">
                                 <i class="mdi mdi-certificate mr-2"></i>Unduh Sertifikat
                              </a>
                           @else
                              <a href="{{ route('events.certificates.store', ['event_user_id' => $user->id]) }}" class="btn btn-inverse-primary btn-sm">
                                 <i class="mdi mdi-check-decagram mr-2"></i>Approve
                              </a>
                           @endif

                        </td>
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