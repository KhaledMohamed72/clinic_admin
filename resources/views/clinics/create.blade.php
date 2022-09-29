@extends('layouts.app')
@section('styles')


@endsection
@section('title')   Clinics    @endsection
@section('header-title')    Clinics    @endsection
@section('header-title-one')    Clinics    @endsection
@section('header-title-two')    Create   @endsection

@section('content')

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Clinic</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{route('clinics.store')}}">
                    @include('clinics.form')
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="create">Submit</button>
                    </div>
                </form>
            </div>


@endsection
@section('scripts')

@endsection
