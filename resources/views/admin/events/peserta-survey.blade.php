@extends('admin.events.head')
@include('layouts.includes.functions')
@section('sub-content')
   <div class="card mb-3">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h4 class="card-title">Peserta Survey</h4>
            {{-- print --}}
         </div>
         
      </div>
   </div>
   @if ($surveys->count() > 0)
      @foreach ($surveys as $survey)
          <div class="card">
            <div class="card-body">
               <h4 class="card-title">{{ $survey->name }}</h4>
               {{-- foreach survey-user --}}
               <table class="table table-striped table-inverse">
                  <thead class="thead-inverse">
                     <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Instansi</th>
                        <th>Kota</th>
                     </tr>
                     </thead>
                     <tbody>
                        @foreach ($survey->survey_user as $user)
                           <tr>
                              <td>{{ $user->user->name }}</td>
                              <td>{{ $user->user->email }}</td>
                              <td>{{ $user->user->institute }}</td>
                              <td>{{ $user->user->city }}</td>
                           </tr>
                        @endforeach
                     </tbody>
               </table>
            </div>
          </div>
      @endforeach
   @else
      <p class="card-description">
         Tidak ada survey
      </p>
   @endif
@endsection