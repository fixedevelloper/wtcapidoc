@extends('admin.layout')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Add customers</h3>

            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div>
    <div class="components-preview wide-lg mx-auto">
        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                <div class="card-inner-group">
                    <div class="card-inner card-bordered mb-3">
                        <form method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="form-label" for="default-01">Name</label>
                                <div class="form-control-wrap">
                                    <input name="name" type="text" class="form-control" id="default-01" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="phone">Phone</label>
                                <div class="form-control-wrap">
                                    <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone">
                                </div>
                            </div><div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <div class="form-control-wrap">
                                        <input name="email" type="text" class="form-control" id="email" placeholder="mount begin">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="form-control-wrap">
                                        <input name="password" type="password" class="form-control" id="password" placeholder="pass">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="form-label" for="address">Address</label>
                                <div class="form-control-wrap">
                                    <input name="address" type="text" class="form-control" id="address" placeholder="address">
                                </div>
                            </div>
                            <div class="form-group col-md-3 mt-4">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>


                    </div><!-- .card-inner -->

                </div><!-- .card-inner-group -->
            </div><!-- .card -->
        </div>
    </div>


@endsection
