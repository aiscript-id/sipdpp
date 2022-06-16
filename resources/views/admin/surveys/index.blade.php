@extends('layouts.admin')
@section('content')
   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h4 class="card-title">Tabel Survey</h4>
            <a href="{{ route('surveys.create') }}">
               <button class="btn btn-inverse-primary btn-sm">
                  <i class="mdi mdi-plus"></i>
                  Tambah
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
                     <th>Publish</th>
                     <th>Nama</th>
                     <th>Jumlah Field</th>
                     <th>Telah Digunakan</th>
                     <th>Telah Diisi oleh</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($surveys as $survey)    
                  <tr>
                     <td class="text-center">
                        {{-- PUBLISH --}}
                        <div class="form-check">
                           <label class="form-check-label">
                              <input type="checkbox" id="publish-{{ $survey->id }}" class="form-check-input" {{ (@$survey->publish == 1) ? 'checked' : '' }} onchange="publish({{ $survey->id }})">
                              {{-- <i class="input-helper"></i> --}}
                           </label>
                        </div>
                     </td>
                     <td class="py-1">
                        <a href="{{ route('surveys.show', $survey->id) }}" class="card-text text-primary" style="text-decoration: none">
                           {{ $survey->name }}
                        </a>
                     </td>
                     <td>{{ $survey->fields_count ?? 0 }}</td>
                     <td>{{ $survey->event_survey->count() ?? 0 }}</td>
                     <td>{{ $survey->survey_user_event->count() ?? 0 }}</td>
                     <td>
                        {{-- question field --}}
                        <a href="{{ route('surveys.fields', $survey->id) }}" class="btn btn-inverse-warning btn-sm">
                           <i class="mdi mdi-eye"></i>
                        </a>
                        <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-sm btn-inverse-info">
                           <i class="mdi mdi-pencil"></i>
                        </a>
                        {{-- confirm delete --}}
                        <form action="{{ route('surveys.destroy', $survey->id) }}" method="POST" class="d-inline show_confirm">
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
         {{ $surveys->links() }}
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
               table:"surveys",
               publish: $('#publish-'+id).prop('checked') ? 1 : 0,
               _token: "{{ csrf_token() }}"
            },
            success: function(data) {
               if (data == 1) {
                  toastr.success('Survey published');
               } else {
                  toastr.success('Survey unpublished');
               }
            }
         });
      }
   </script>
   @endsection
@endsection