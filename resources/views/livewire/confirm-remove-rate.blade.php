<div class="nk-tb-col nk-tb-col-tools">

    <!-- Bouton pour ouvrir le modal -->
    <a class="btn btn-danger btn-sm" wire:click="openModal" ><em class="icon ni ni-trash"></em></a>
    <!-- Modal -->
    <div class="modal fade @if($isOpen) show @endif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="@if($isOpen) display: block; @endif">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm delete rate</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-bordered">
                        <p>Do you really want to delete this item?</p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>

                </div>
            </div>
        </div>
    </div>

</div>
@if(!$isOpen)
    <script>
        window.addEventListener('closeModal', event => {
            location.reload();
        });
    </script>
@endif
