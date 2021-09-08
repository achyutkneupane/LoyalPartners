@section('title',$property->title)
<div class='container-fluid'>
    <div class='row justify-content-center'>
        <div class='col-lg-7'>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Property Details</h5>
                    <p class="card-text">
                        <dl class='row'>
                            <dt class='col-lg-3'>
                                Title:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                {{ $property->title }}
                            </dd>
                            <dt class='col-lg-3'>
                                Description:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                {{ $property->description }}
                            </dd>
                            <dt class='col-lg-3'>
                                Household Member:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                {{ $property->household ? $property->household->name : 'N/A' }}
                            </dd>
                            <dt class='col-lg-3'>
                                Tenant:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                {{ $property->tenant ? $property->tenant->name : 'N/A' }}
                            </dd>
                            <dt class='col-lg-3'>
                                Residential Tenancy Agreement:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                @if($property->hasMedia('rta'))
                                <a href='{{ $property->rta->getUrl() }}' target='_blank'>
                                    {{ $property->rta->name }}
                                    <br>
                                    ({{ $property->rta->human_readable_size }})
                                </a>
                                @elseif($rta)
                                <button class='btn btn-success' wire:click='uploadRta'>Upload</button>
                                @else
                                @role('tenant')
                                <div wire:loading wire:target="rta">Processing...</div>
                                <div wire:loading.remove class="custom-file">
                                    <label class="custom-file-label text-left" for="customFile">Choose file</label>
                                    <input type="file" class="custom-file-input" id="customFile" wire:model='rta'>
                                </div>
                                @else
                                <div class='text-muted'>N/A</div>
                                @endrole
                                @endif
                            </dd>
                        </dl>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>