@extends('layouts.admin')
@section('content')
   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h4 class="card-title">Tabel User</h4>
            <a href="{{ route('users.create') }}">
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
                     <th>User</th>
                     <th>Email</th>
                     <th>JK</th>
                     <th>Instansi/Sekolah</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($users as $user)    
                  <tr>
                     <td class="py-1">
                        <img src="{{ $user->getAvatar }}" class="mr-2" alt="image">
                        <span>{{ $user->name }}</span>
                     </td>
                     <td>{{ $user->email }}</td>
                     <td>{{ Str::title($user->gender ?? '-')  }}</td>
                     <td>{{ $user->institute ?? '-' }}</td>
                     <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-inverse-info">
                           <i class="mdi mdi-pencil"></i>
                        </a>
                        {{-- confirm delete --}}
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline show_confirm">
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
         {{ $users->links() }}
      </div>
   </div>
@endsection