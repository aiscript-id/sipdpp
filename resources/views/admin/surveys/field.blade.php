@extends('layouts.admin')
@section('content')
   <div class="card mb-3">
      <div class="card-body">
         <div class="d-flex justify-content-between mb-4">
            <h4 class="card-title">{{ $survey->name }}</h4>
            <a href="{{ route('surveys.index') }}">
               <button class="btn btn-inverse-secondary btn-sm">
                  {{-- <i class="mdi mdi-chevron-left"></i> --}}
                  Kembali
               </button>
            </a>
         </div>
         <p class="card-description">
            {{ $survey->description }}
         </p>
      </div>
   </div>

   {{-- alert --}}
   <div class="alert alert-warning border-0" role="alert">
      Pastikan isian servey telah diisi dengan benar. 
      Jika survey telah dipublish maka tidak dapat diubah.
   </div>

   {{-- peserta --}}
   <div class="card">
      <div class="card-body">
         <div class="d-flex justify-content-between">
            <h4 class="card-title">Isian Survey</h4>
            {{-- btn modal --}}
            <button type="button" class="btn btn-inverse-primary btn-sm" data-toggle="modal" data-target="#modal-update-field">
               <i class="mdi mdi-plus"></i> Tambah
            </button>
            {{-- modal --}}
            <x-modal-survey-field  :survey="$survey" />
         </div>
         {{-- table survey field --}}
         <div class="table-responsive">
            <table class="table table-striped table-sm">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Nama</th>
                     <th>Isian</th>
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($survey->fields as $field)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Str::limit($field->question, 100, '...') }}</td>
                        <td>{{ Str::title($field->type) }}</td>
                        <td>
                           {{-- btn modal --}}
                           <button type="button" class="btn btn-inverse-info btn-sm" data-toggle="modal" data-target="#modal-update-field{{ $field->id }}">
                              <i class="mdi mdi-pencil"></i>
                           </button>

                           {{-- btn show --}}
                           <a href="{{ route('surveys.fields.show', ['field' => $field->id, 'survey' => $survey->id]) }}" class="btn btn-inverse-primary btn-sm">
                              <i class="mdi mdi-eye"></i>
                           </a>

                           {{-- modal --}}
                           <x-modal-survey-field :field="$field" :survey="$survey" />
                           <form action="{{ route('fields.destroy', $field->id) }}" method="POST" class="d-inline show_confirm">
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
      </div>
   </div>  
   

@endsection