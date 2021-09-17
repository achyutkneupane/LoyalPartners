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
                                @if(($property->household && $property->household->id == auth()->id()) || auth()->user()->type == 'director' || ($property->tenant && $property->tenant->id == auth()->id()))
                                {!! $property->household ? "<a href='".route('profileView',$property->household->id)."'>".$property->household->name."</a>" : 'N/A' !!}
                                @else
                                {{ $property->household ? $property->household->name : 'N/A' }}
                                @endif
                            </dd>
                            <dt class='col-lg-3'>
                                Tenant:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                @if(($property->household && $property->household->id == auth()->id()) || auth()->user()->type == 'director' || ($property->tenant && $property->tenant->id == auth()->id()))
                                {!! $property->tenant ? "<a href='".route('profileView',$property->tenant->id)."'>".$property->tenant->name."</a>" : 'N/A' !!}
                                @else
                                {{ $property->tenant ? $property->tenant->name : 'N/A' }}
                                @endif
                                @if($property->tenant)({!! $property->tenant_status ? '<span class="text-success">Verified</span>' : '<span class="text-danger">Not Verified</span>' !!})@endif
                            </dd>
                            <dt class='col-lg-5'>
                                Residential Tenancy Agreement(Household):
                            </dt>
                            <dd class='col-lg-7 text-right'>
                                @if($property->hasMedia('hrta'))
                                <a href='{{ $property->hrta->getUrl() }}' target='_blank'>
                                    {{ $property->hrta->name }}
                                    <br>
                                    ({{ $property->hrta->human_readable_size }})
                                </a>
                                @elseif($hrta)
                                <button class='btn btn-success' wire:click='uploadHrta'>Upload</button>
                                @else
                                    @if($property->household == auth()->user())
                                    <div wire:loading wire:target="hrta">Processing...</div>
                                    <div wire:loading.remove wire:target="hrta" class="custom-file">
                                        <label class="custom-file-label text-left" for="customFile">Choose file</label>
                                        <input type="file" class="custom-file-input" id="customFile" wire:model='hrta'>
                                    </div>
                                    @else
                                    <div class='text-muted'>N/A</div>
                                    @endif
                                @endif
                            </dd>
                            <dt class='col-lg-5'>
                                Residential Tenancy Agreement(Tenant):
                            </dt>
                            <dd class='col-lg-7 text-right'>
                                @if($property->hasMedia('trta'))
                                <a href='{{ $property->trta->getUrl() }}' target='_blank'>
                                    {{ $property->trta->name }}
                                    <br>
                                    ({{ $property->trta->human_readable_size }})
                                </a>
                                @elseif($trta)
                                <button class='btn btn-success' wire:click='uploadTrta'>Upload</button>
                                @else
                                @role('tenant')
                                <div wire:loading wire:target="trta">Processing...</div>
                                <div wire:loading.remove wire:target="trta" class="custom-file">
                                    <label class="custom-file-label text-left" for="customFile">Choose file</label>
                                    <input type="file" class="custom-file-input" id="customFile" wire:model='trta'>
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