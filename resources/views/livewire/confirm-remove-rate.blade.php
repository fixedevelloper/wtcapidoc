<div class="nk-tb-col nk-tb-col-tools">
    <ul class="nk-tb-actions gx-2">
        <li>
    <!-- Bouton pour ouvrir le modal -->
    <li><a class="btn btn-danger" wire:click="openModal" ><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
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
    </ul>
</div>
@if(!$isOpen)
    <script>
        window.addEventListener('closeModal', event => {
            location.reload();
        });
    </script>
@endif
