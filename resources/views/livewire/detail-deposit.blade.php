<div>
    <!-- Bouton pour ouvrir le modal -->
    <li><a class="btn btn-primary" wire:click="openModal" ><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
    <!-- Modal -->
    <div class="modal fade @if($isOpen) show @endif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="@if($isOpen) display: block; @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details deposit</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-bordered">
                        <ul class="data-list is-compact">
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Submitted By</div>
                                    <div class="data-value">{{$deposit->customer->user->name}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Submitted At</div>
                                    <div class="data-value">{{$deposit->created_at}}</div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Status</div>
                                    <div class="data-value">
                                        <span class="badge badge-dim badge-sm {{ $deposit->stringStatus->class }}">{{$deposit->stringStatus->value}}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="data-item">
                                <div class="data-col">
                                    <div class="data-label">Amount</div>
                                    <div class="data-value">
                                        <span>{{number_format($deposit['amount'],2)}} XAF</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card p-4">
                        <div class="mt-3">
                            <p><strong>Proof :</strong></p>
                        <img src="{{ asset("storage/".$deposit['proof_image']) }}" width="200" class="rounded shadow">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    @if($deposit->status!=\App\Helpers\Helper::STATUSSUCCESS || $deposit->status!=\App\Helpers\Helper::STATUSFAILD)
                    <button type="button" class="btn btn-success" wire:click="validateDeposit" data-bs-dismiss="modal">Validate</button>
                    @endif
                    <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
