@extends('errors.layout')

@section('title', 'Page non trouvée')

@section('content')
    <div class="nk-block nk-block-middle wide-xs mx-auto">
        <div class="nk-block-content nk-error-ld text-center">
            <h1 class="nk-error-head">505</h1>
            <h3 class="nk-error-title">Gateway Timeout Error</h3>
            <p class="nk-error-text">We are very sorry for inconvenience. It looks like some how our server did not receive a timely response.</p>
            <a href="{{url('/')}}" class="btn btn-lg btn-primary mt-2">Back To Home</a>
        </div>
    </div>
@endsection
