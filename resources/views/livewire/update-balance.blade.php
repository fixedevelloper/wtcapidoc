<div>
    <div class="data-value">
        {{$balance_old}} XAF
    </div>
    <button class="btn btn-primary" x-on:click="$wire.showModal = true" wire:show="!showModal">Update balance</button>

    <div wire:show="showModal">
        <form wire:submit="save">
            <div class="row">

                <div class="input-group mb-3">
                    <input wire:model="balance" type="text" class="form-control" placeholder="0.0" aria-label="0.0" aria-describedby="button-addon2">
                    <button class="btn btn-success" type="submit" id="button-addon2">Update</button>
                </div>
            </div>

        </form>
    </div>
</div>
