{{-- modal update field --}}
<div class="modal fade" id="modal-update-field{{ @$field->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-update-field{{ @$field->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="modal-update-field">Update Field</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
            @if (@$field)
                <form action="{{ route('fields.update', ['field' => $field->id, 'survey_id' => $survey->id]) }}" method="POST">
                @method('PUT')
            @else
                <form action="{{ route('fields.store', ['survey_id' => $survey->id]) }}" method="POST">
            @endif
                @csrf
                <div class="form-group">
                   <label for="question">Pertanyaan</label>
                   <input type="text" class="form-control" id="question" placeholder="masukan pertanyaan survey" name="question" value="{{ @$field->question }}">
                </div>
                @php
                    $type = ['text' , 'radio' , 'checkbox' , 'select' , 'number' , 'textarea'];
                @endphp
                <div class="form-group">
                   <label for="type">Tipe</label>
                   <select class="form-control" id="type" name="type">
                        <option value="" >Pilih</option>
                        @foreach ($type as $ty)
                            <option value="{{ $ty }}" {{ @$field->type === $ty ? 'selected' : '' }}>{{ Str::title($ty) }}</option>
                        @endforeach
                   </select>
                </div>
                <div class="text-right">
                    <button class="btn btn-inverse-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
             </form>
          </div>
       </div>
    </div>
 </div>