<div>
    @if ($visible)
        <div class="components-preview wide-md mx-auto">
            <div class="nk-block-head nk-block-head-lg wide-sm">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub"><a class="back-to" href="{{route('secure.deposits')}}"><em
                                class="icon ni ni-arrow-left"></em><span>Deposits</span></a></div>
                    <h2 class="nk-block-title fw-normal">Make deposit </h2>
                    <div class="nk-block-des">
                        <p class="lead"></p>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg">
                <div class="card card-bordered">
                    <div class="row g-0 col-sep col-sep-md col-sep-xl">
                    <div class="col-md-4 col-xl-4">
                        <div class="card-inner">
                            <h5>Instruction!</h5>
                            <p class="text-soft mt-3">Please take a screenshot of the payment and submit it using the form.
                                Our team will verify it within 30 minutes.</p>
                        </div>
                    </div>
                    <div class="col-md-8 col-xl-8">
                        <div class="card-inner">
                            <div class="col-md-4 col-sm-4 text-center">
                                <input type="file" wire:model="photo" id="image_upload" accept="image/*" class="form-control custom-input-image">
                                <div class="card p-4 border border-3">
                                    <i class="ni ni-camera-fill ni-view-x3"></i>
                                    <label for="image_upload" class="label_upload">Select file</label>
                                </div>
                            </div>
                            @error('photo') <span class="text-danger">{{ $message }}</span> @enderror

                            @if ($photo)
                                <div class="mt-3">
                                    <p><strong>Aperçu :</strong></p>
                                    <img src="{{ $photo->temporaryUrl() }}" width="200" class="rounded shadow">
                                </div>
                                <button  class="btn btn-dim btn-primary mt-3">Send</button>
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
