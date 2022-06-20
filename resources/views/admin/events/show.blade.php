@extends('admin.events.head')
@section('sub-content')
<style>
   iframe {
      width: 100%!important;
      height: 100%!important;
   }
</style>

   {{-- peserta --}}
   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-between mb-4">
            <h4 class="card-title">Sesi Kegiatan</h4>
            {{-- create sesi modal --}}
            <a href="{{ route('events.sesi.create', $event->id) }}" class="btn btn-inverse-primary btn-sm">
               <i class="mdi mdi-plus"></i>
               Tambah Sesi
            </a>
         </div>
         @if ($event->sesi_count > 0)
            <div class="table-responsive mb-2">
               <table class="table table-sm table-striped">
                  <thead>
                     <tr>
                        <th>Kegiatan</th>
                        <th>Nama</th>
                        <th>Pemateri</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Content</th>
                        <th>Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($sesis as $sesi)    
                     <tr>
                        <td>
                           <span class="badge badge-outline-{{ $sesi->colorType }} mb-0 font-weight-bold">{{ $sesi->type }}</span>
                        </td>
                        <td class="py-1">{{ $sesi->name }}</td>
                        <td>{{ $sesi->mentor->name ?? '-' }}</td>
                        <td>{{ $sesi->getDate }}</td>
                        <td>{{ $sesi->getTime }}</td>
                        <td>
                           @if ($sesi->type == 'materi')
                              <a name="" id="" class="btn btn-primary btn-sm" href="{{ $sesi->content }}" target="_blank" >Lihat Materi</a>
                           @elseif($sesi->type == 'video')
                              <a href="javascript:;" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-video-{{ $sesi->id }}">Lihat Video</a>
                           @elseif($sesi->type == 'tugas')
                              -
                           @endif
                        </td>
                        <td>
                           {{-- botton modal show --}}
                           <button type="button" class="btn btn-sm btn-inverse-warning" data-toggle="modal" data-target="#modal-show-{{ $sesi->id }}">
                              <i class="mdi mdi-eye"></i>
                           </button>
                           {{-- edit --}}
                           @if ($sesi->type == 'tugas')
                              <a href="{{ route('events.tugas.nilai', ['sesi' => $sesi->id]) }}" class="btn btn-sm btn-inverse-info">
                                 <i class="mdi mdi-checkbox-multiple-marked-outline"></i>
                              </a>
                           @else
                           <a href="{{ route('events.sesi.edit', ['event' => $event->id, 'sesi' => $sesi->id]) }}" class="btn btn-sm btn-inverse-primary">
                              <i class="mdi mdi-pencil"></i>
                           </a>
                           @endif
                           {{-- delete --}}
                           <form action="{{ route('events.sesi.destroy', $sesi->id) }}" method="POST" class="d-inline show_confirm">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-inverse-danger">
                                 <i class="mdi mdi-delete"></i>
                              </button>
                           </form>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            {{ $sesis->links() }}
         @else
            <p class="card-description">
               Tidak ada sesi dalam event ini
            </p>
         @endif
      </div>
   </div>

   {{-- modal show --}}
   @foreach ($sesis as $sesi)
   <div class="modal fade" id="modal-show-{{ $sesi->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-show-{{ $sesi->id }}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="modal-show-{{ $sesi->id }}">{{ $sesi->name }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12 mb-4">
                     {{-- mentor photo --}}
                     <div class="d-flex">
                        <img src="{{ $sesi->mentor->image ?? 'https://via.placeholder.com/150' }}" alt="{{ $sesi->mentor->name ?? '-' }}" class="rounded-circle mr-2" width="50" height="50">
                        {{-- name --}}
                        <p class="mt-1">
                           {{ $sesi->mentor->name ?? '-' }}
                           <br>
                           <span class="text-sm text-muted" style="font-size: 9pt">Pemateri</span>
                        </p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <p class="card-description">
                        <i class="mdi mdi-clock"></i>
                        {{ $sesi->getTime }}
                     </p>
                  </div>
                  <div class="col-md-6">
                     <p class="card-description">
                        <i class="mdi mdi-calendar"></i>
                        {{ $sesi->getDate }}
                     </p>
                  </div>
               </div>
               <hr>
               <div class="row">
                  <div class="col-md-12">
                     <p class="card-description">
                        {{ $sesi->description }}
                     </p>
                  </div>
               </div>
            </div>
            <div class="modal-footer d-none">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
         </div>
      </div>
   </div>

   @if ($sesi->type == 'video')
   <div class="modal fade" id="modal-video-{{ $sesi->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-video-{{ $sesi->id }}" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="modal-video-{{ $sesi->id }}">{{ $sesi->name }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12 mb-4 w-100">
                     <div style="max-width: 100%" >
                        {!! $sesi->content !!}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endif
   @endforeach


   
@endsection