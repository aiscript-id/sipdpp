@extends('layouts.admin')
@section('content')
   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h4 class="card-title">Tabel Event</h4>
            <div>
               <a href="{{ route('events.create') }}">
                  <button class="btn btn-inverse-primary btn-sm">
                     <i class="mdi mdi-plus"></i>
                     Tambah
                  </button>
               </a>
               {{-- button cetak --}}
               <a href="#">
                  <button class="btn btn-inverse-primary btn-sm">
                     <i class="mdi mdi-printer"></i>
                     Cetak
                  </button>
               </a>
            </div>
         </div>
         <p class="card-description">
            {{-- Add class <code>.table-striped</code> --}}
         </p>
         <div class="table-responsive mb-2">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>Publish</th>
                     <th>Nama</th>
                     <th>Peserta</th>
                     <th>Tanggal</th>
                     <th>Lokasi</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($events as $event)    
                  <tr>
                     <td class="text-center">
                        {{-- PUBLISH --}}
                        <div class="form-check">
                           <label class="form-check-label">
                              <input type="checkbox" id="publish-{{ $event->id }}" class="form-check-input" {{ (@$event->publish == 1) ? 'checked' : '' }} onchange="publish({{ $event->id }})">
                              {{-- <i class="input-helper"></i> --}}
                           </label>
                        </div>
                     </td>
                     <td class="py-1">
                        <a href="{{ route('events.show', $event->id) }}" class="card-text text-primary" style="text-decoration: none">
                           {{ $event->name }}
                        </a>
                     </td>
                     <td>{{ $event->users_count ?? 0 }}</td>
                     <td>{{ $event->getDate }}</td>
                     <td>{{ $event->location ?? '-' }}</td>
                     <td>
                        {{-- peserta --}}
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-inverse-warning" title="Detail">
                           <i class="mdi mdi-account"></i>
                        </a>
                        <a href="{{ route('events.surveys', $event->id) }}" class="btn btn-sm btn-inverse-primary" title="Survey">
                           <i class="mdi mdi-clipboard-text"></i>
                        </a>
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-inverse-info">
                           <i class="mdi mdi-pencil"></i>
                        </a>
                        {{-- confirm delete --}}
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline show_confirm">
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
         {{ $events->links() }}
      </div>
   </div>
   @section('script')    
   <script>
      function publish(id) {
         $.ajax({
            url: "{{ route('admin.publish') }}",
            type: "PUT",
            data: {
               id: id,
               table:"events",
               publish: $('#publish-'+id).prop('checked') ? 1 : 0,
               _token: "{{ csrf_token() }}"
            },
            success: function(data) {
               if (data == 1) {
                  toastr.success('Event published');
               } else {
                  toastr.success('Event unpublished');
               }
            }
         });
      }
   </script>
   @endsection
@endsection