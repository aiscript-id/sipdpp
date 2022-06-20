@extends('layouts.admin')
@section('content')
   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h4 class="card-title">Penilaian Tugas : {{ $sesi->name }}</h4>
            <a href="{{ route('events.show', $event->id) }}">
               <button class="btn btn-inverse-secondary btn-sm">
                  {{-- <i class="mdi mdi-chevron-left"></i> --}}
                  Kembali
               </button>
            </a>
         </div>
         <p class="card-description">
            {{-- Add class <code>.table-striped</code> --}}
         </p>
         <div class="table-responsive mb-2">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Nama</th>
                     <th>Tugas</th>
                     <th>Nilai</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($nilais as $nilai)    
                  <tr>
                     <td class="text-center">
                        {{ $loop->iteration }}
                     </td>
                     <td class="py-1">
                        {{ $nilai->user->name }}
                     </td>
                     <td>{{ $nilai->test }}</td>
                     <td>{{ $nilai->nilai }}</td>
                     <td>

                     </td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="5" class="text-center">Belum ada data tugas</td>
                  </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
         {{ $nilais->links() }}
      </div>
   </div>
   @section('script')    
   <script>
   </script>
   @endsection
@endsection