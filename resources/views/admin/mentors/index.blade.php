@extends('layouts.admin')
@section('content')
   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h4 class="card-title">Tabel Mentor / Pemateri</h4>
            <div>
                {{-- button modal create --}}
                <button type="button" class="btn btn-inverse-primary btn-sm" data-toggle="modal" data-target="#modal-create">
                    <i class="mdi mdi-plus"></i>
                    Tambah
                </button>
            </div>
         </div>
         <p class="card-description">
            {{-- Add class <code>.table-striped</code> --}}
         </p>
         <div class="table-responsive mb-2">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Photo</th>
                     <th>Nama</th>
                     <th>Deskripsi</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($mentors as $mentor)    
                  <tr>
                     <td class="text-center">
                        {{ $loop->iteration }}
                     </td>
                     <td class="py-1">
                        {{-- image --}}
                        <img src="{{ $mentor->getImage }}" alt="{{ $mentor->name }}" class="">
                     </td>
                     <td>{{ $mentor->name }}</td>
                     <td>{{ Str::limit($mentor->description, 50, '...') }}</td>
                     <td>
                        {{-- edit modal button --}}
                        <button type="button" class="btn btn-sm btn-inverse-warning" data-toggle="modal" data-target="#modal-edit-{{ $mentor->id }}">
                            <i class="mdi mdi-pencil"></i>
                            Edit
                        </button>
                        {{-- confirm delete --}}
                        <form action="{{ route('mentors.destroy', $mentor->id) }}" method="POST" class="d-inline show_confirm">
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
         {{ $mentors->links() }}
      </div>
   </div>

   {{-- modal mentor create name description --}}
    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="modal-create-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-create-label">Tambah Mentor / Pemateri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('mentors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Photo</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    @foreach ($mentors as $mentor)
    <div class="modal fade" id="modal-edit-{{ $mentor->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-edit-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-edit-label">Edit Mentor / Pemateri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ route('mentors.update', $mentor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ $mentor->name }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $mentor->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Photo</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
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