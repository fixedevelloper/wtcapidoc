@extends('errors.layout')

@section('title', 'Internal Server Error')

@section('content')
    <div class="nk-block nk-block-middle wide-xs mx-auto">
        <div class="nk-block-content nk-error-ld text-center">
            <h1 class="nk-error-head">503</h1>
            <h3 class="nk-error-title">Oops! Why you’re here?</h3>
            <p class="nk-error-text">We are very sorry for inconvenience. Internal Server Error .</p>
            <a href="{{url('/')}}" class="btn btn-lg btn-primary mt-2">Back To Home</a>
        </div>
    </div>
@endsection
