@extends('layouts.app')

@section('content')

    <hr>
    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <a href="{{ url('/api/auth/google/redirect') }}" class="btn btn-primary"><i class="fa fa-google"></i> Google</a>
        </div>
    </div>

@endsection