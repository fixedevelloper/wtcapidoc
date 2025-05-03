<div class="toggle-expand-content" data-content="pageMenu">
    <ul class="nk-block-tools g-3">
        <li><a wire:click="openModal" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
    </ul>

    <div class="modal fade @if($isOpen) show @endif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="@if($isOpen) display: block; @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export transaction</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="form-group">
                            <label class="form-label">File type</label>
                            <ul class="custom-control-group g-3 align-center">
                                <li>
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input wire:model.live="file_type" type="radio" name="file_type" class="custom-control-input" id="pay-card">
                                        <label class="custom-control-label" for="pay-card">PDF</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input wire:model.live="file_type" type="radio" name="file_type" class="custom-control-input" id="pay-bitcoin">
                                        <label class="custom-control-label" for="pay-bitcoin">EXCEL</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="custom-control custom-switch">
                            <input  wire:model.live="isPeriodic" type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Periodic?</label>
                        </div>
                        @if($isPeriodic)
                        <div class="form-group">
                            <label class="form-label" for="default-05">Date start</label>
                            <div class="form-control-wrap">
                                <input wire:model.live="start_date" name="start_date" type="date" class="form-control" id="default-05" placeholder="Input placeholder">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="default-01">Date end</label>
                            <div class="form-control-wrap">
                                <input wire:model.live="end_date" type="date" class="form-control " id="default-01" placeholder="Input placeholder">
                            </div>
                        </div>
                            @endif
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="export" data-bs-dismiss="modal">Export</button>
                    <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
