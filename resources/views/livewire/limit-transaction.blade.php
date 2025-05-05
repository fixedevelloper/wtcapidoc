<div>
    <a wire:click="openModal" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Details" data-bs-original-title="Max transaction">
        <em class="icon ni ni-user-switch-fill"></em>
    </a>
   {{-- <li><a  wire:click="openModal" ><em class="icon ni ni-repeat"></em><span>Transaction</span></a></li>--}}
    <div class="modal fade @if($isOpen) show @endif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="@if($isOpen) display: block; @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update sender limit transaction</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <p class="fw-bold">Sender Max:  {{$sender->max_transaction}} FCFA</p>
                            <div class="form-group">
                                <label class="form-label" for="default-05">Max transaction per month</label>
                                <div class="form-control-wrap">
                                    <input wire:model.live="max_transaction" name="max_transaction" type="text" class="form-control" id="default-05" placeholder="Input placeholder">
                                </div>
                            </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="save" data-bs-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @if($isOpen)
        <div class="modal-backdrop fade show"></div>
    @endif

</div>
