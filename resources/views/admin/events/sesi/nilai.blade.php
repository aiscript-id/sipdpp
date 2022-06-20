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
                     <td>{{ $nilai->nilai ?? 0 }}</td>
                     <td>
                        {{-- modal edit --}}
                        <button type="button" class="btn btn-inverse-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $nilai->id }}">
                           <i class="mdi mdi-pencil"></i>
                        </button>

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

   {{-- modal edit --}}
   @foreach ($nilais as $nilai)
   <div class="modal fade" id="editModal{{ $nilai->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="editModalLabel">Edit Nilai</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="{{ route('events.nilai.update', ['nilai_id' => $nilai->id]) }}" method="POST">
               @csrf
               @method('PUT')
               <div class="modal-body">
                  <div class="form-group">
                     <label for="nilai">Nilai</label>
                     <input type="number" class="form-control" id="nilai" name="nilai" max="100" min="0" value="{{ $nilai->nilai }}">
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   @endforeach


   @section('script')    
   <script>
   </script>
   @endsection
@endsection