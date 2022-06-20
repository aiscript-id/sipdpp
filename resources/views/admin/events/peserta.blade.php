@extends('admin.events.head')
@section('sub-content')
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