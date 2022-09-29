@csrf
<div class="card-body">
    @php $input = 'name' @endphp
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInput{{$input}}">Username</label>
            <input type="text" name="{{$input}}" value="{{isset($row[0]) ? $row[0]->$input : old($input)}}"
                   class="form-control @error($input) is-invalid @enderror" id="exampleInput{{$input}}"
                   placeholder="Enter {{$input}}">
            @error($input)<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>
    @php $input = 'email' @endphp
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInput{{$input}}">Email</label>
            <input type="email" name="{{$input}}" value="{{isset($row[0]) ? $row[0]->$input : old($input)}}"
                   class="form-control @error($input) is-invalid @enderror" id="exampleInput{{$input}}"
                   placeholder="Enter {{$input}}">
            @error($input)<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Clinic</label>
            <select name="clinic_id" class="form-control select2" style="width: 100%;">
                <option>Select Clinic</option>
                @foreach($clinics as $clinic)
                    <option value="{{$clinic->id}}" {{isset($row[0]) && $row[0]->clinic_id == $clinic->id ? 'selected' : ''}}>{{$clinic->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @php $input = 'password' @endphp
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInput{{$input}}">Passwoed</label>
            <input type="password" name="{{$input}}" value=""
                   class="form-control @error($input) is-invalid @enderror" id="exampleInput{{$input}}"
                   placeholder="Enter {{$input}}">
            @error($input)<span class="invalid-feedback"
                                role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>
    @php $input = 'password_confirmation' @endphp
    <div class="col-md-6">
        <div class="form-group">
            <label for="exampleInput{{$input}}">Confirm Password</label>
            <input type="password" name="{{$input}}" value="{{old('password_confirmation')}}"
                   class="form-control" id="exampleInput{{$input}}"
                   placeholder="Confirm your password">
            @error('password_confirmation')<span class="invalid-feedback"
                                                 role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
    </div>
    <!-- /.card-body -->
</div>
