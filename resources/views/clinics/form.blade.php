{{ csrf_field() }}
@php $input = 'name' @endphp
<div class="card-body">
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInput{{$input}}">Name</label>
            <input type="text" name="{{$input}}" value="{{isset($row) ? $row->$input : old($input)}}"
                   class="form-control @error($input) is-invalid @enderror" id="exampleInput{{$input}}"
                   placeholder="Enter {{$input}}">
            @error($input)<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>
    @php $input = 'domain' @endphp
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInput{{$input}}">Domain</label>
            <input type="text" name="{{$input}}" value="{{isset($row) ? $row->$input : old($input)}}"
                   class="form-control @error($input) is-invalid @enderror" id="exampleInput{{$input}}"
                   placeholder="Enter {{$input}}">
            @error($input)<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>
    @php $input = 'type' @endphp
    <div class="col-md-6">
        <div class="form-group">
            <label>Type</label>
            <select name="{{$input}}" class="form-control select2" style="width: 100%;">
                <option value="0" {{(isset($row) && $row->$input == 0 ? 'selected' : '')}}>Single Doctor</option>
                <option value="1" {{(isset($row) && $row->$input == 1 ? 'selected' : '')}}>Multiple Doctor</option>
            </select>
        </div>
    </div>
    @php $input = 'active' @endphp
    <div class="col-md-6">
        <div class="form-group">
            <label>Activation</label>
            <select name="{{$input}}" class="form-control select2" style="width: 100%;">
                <option value="1" {{(isset($row) && $row->$input == 1 ? 'selected' : '')}}>Active</option>
                <option value="0" {{(isset($row) && $row->$input == 0 ? 'selected' : '')}}>Blocked</option>
            </select>
        </div>
    </div>

@php $input = 'phone' @endphp
<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInput{{$input}}">Phone</label>
        <input type="number" name="{{$input}}" value="{{isset($row) ? $row->$input : old($input)}}"
               class="form-control  @error($input) is-invalid @enderror" id="exampleInput{{$input}}"
               placeholder="Enter {{$input}}">
        @error($input)<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
<!-- /.card-body -->
</div>
