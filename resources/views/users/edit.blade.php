@extends('layouts.app')
@section('styles')


@endsection
@section('title')   Users    @endsection
@section('header-title')    Users    @endsection
@section('header-title-one')    Users    @endsection
@section('header-title-two')    Create   @endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{route('users.update' , $row[0]->id)}}">
            {{ method_field('put') }}
            @include('users.form')
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="update">Submit</button>
            </div>
        </form>
    </div>

@endsection
@section('scripts')

@endsection
