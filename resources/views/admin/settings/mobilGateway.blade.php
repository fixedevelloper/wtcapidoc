@extends('admin.layout')
@section('content')
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between g-3">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Payment Gateway Mobile/ <strong class="text-primary small">{{$country->name}}</strong></h3>
                    <div class="nk-block-des text-soft">
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="{{route('admin.countries')}}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                    <a href="{{route('admin.countries')}}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <livewire:mobli-gateway :country="$country"/>
        </div><!-- .nk-block -->
    </div>
@endsection
@push('js')
    <script>
        Livewire.on('alert', data => {
            console.log(data[0])
            toastr.success(data[0].message, '200!')
            //alert(data[0].message); // Ou utilise Toastify, SweetAlert, etc.
        });
    </script>
@endpush
