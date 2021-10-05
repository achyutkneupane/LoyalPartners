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
                            <dd class='text-right col-lg-9'>
                                {{ $property->title }}
                            </dd>
                            <dt class='col-lg-3'>
                                Description:
                            </dt>
                            <dd class='text-right col-lg-9'>
                                {{ $property->description }}
                            </dd>
                            <dt class='col-lg-3'>
                                Amount:
                            </dt>
                            <dd class='text-right col-lg-9'>
                                AUD <b>{{ $property->price }}</b> @if($property->paid_at)<span class='text-bold text-success'>(Paid)</span>
                                @else
                                <span class='text-bold text-danger'>(Unpaid)</span>
                                    @if($property->tenant_status && $property->household->id == auth()->id())
                                        <button type="button" class="btn btn-info btn-sm" onclick="payForProperty()">Pay</button>
                                    @endif
                                @endif
                            </dd>
                            <dt class='col-lg-3'>
                                Household Member:
                            </dt>
                            <dd class='text-right col-lg-9'>
                                @if(($property->household && $property->household->id == auth()->id()) || auth()->user()->type == 'director' || ($property->tenant && $property->tenant->id == auth()->id()))
                                {!! $property->household ? "<a href='".route('profileView',$property->household->id)."'>".$property->household->name."</a>" : 'N/A' !!}
                                @else
                                {{ $property->household ? $property->household->name : 'N/A' }}
                                @endif
                            </dd>
                            <dt class='col-lg-3'>
                                Tenant:
                            </dt>
                            <dd class='text-right col-lg-9'>
                                @if(($property->household && $property->household->id == auth()->id()) || ($property->tenant && $property->tenant->id == auth()->id()))
                                {!! $property->tenant ? "<a href='".route('profileView',$property->tenant->id)."'>".$property->tenant->name."</a>" : 'N/A' !!}
                                @elseif(auth()->user()->type == 'director')
                                    @if($property->tenant)
                                    <a href="{{ route('profileView',$property->tenant->id) }}">
                                        {{ $property->tenant->name }}
                                    </a>
                                    @else
                                    <span class='text-muted'>N/A</span>
                                    @endif
                                    @if(!$property->tenant_status)
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#changeTenant">Change</button>
                                    @endif
                                @else
                                {{ $property->tenant ? $property->tenant->name : 'N/A' }}
                                @endif
                                @if($property->tenant)({!! $property->tenant_status ? '<span class="text-success">Verified</span>' : '<span class="text-danger">Not Verified</span>' !!})@endif
                            </dd>
                        </dl>
                    </p>
                    @if($property->purpose == 'residence')
                    <h5 class="card-title">
                        Residential Tenancy Agreement
                    </h5>
                    <p class="card-text">
                        <dl class='row'>
                            <dt class='col-lg-5'>
                                By Household:
                            </dt>
                            <dd class='text-right col-lg-7'>
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
                                        <label class="text-left custom-file-label" for="customFile">Choose file</label>
                                        <input type="file" class="custom-file-input" id="customFile" wire:model='hrta'>
                                    </div>
                                    @error('hrta')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                    @else
                                    <div class='text-muted'>N/A</div>
                                    @endif
                                @endif
                            </dd>
                            <dt class='col-lg-5'>
                                By Tenant:
                            </dt>
                            <dd class='text-right col-lg-7'>
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
                                    <label class="text-left custom-file-label" for="customFile">Choose file</label>
                                    <input type="file" class="custom-file-input" id="customFile" wire:model='trta'>
                                </div>
                                @error('trta')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                @else
                                <div class='text-muted'>N/A</div>
                                @endrole
                                @endif
                            </dd>
                        </dl>
                    </p>
                    @else
                    <h5 class="card-title">
                        Lease Agreement
                    </h5>
                    <p class="card-text">
                        <dl class='row'>
                            <dt class='col-lg-5'>
                                By Household:
                            </dt>
                            <dd class='text-right col-lg-7'>
                                @if($property->hasMedia('hla'))
                                <a href='{{ $property->hla->getUrl() }}' target='_blank'>
                                    {{ $property->hla->name }}
                                    <br>
                                    ({{ $property->hla->human_readable_size }})
                                </a>
                                @elseif($hla)
                                <button class='btn btn-success' wire:click='uploadHla'>Upload</button>
                                @else
                                    @if($property->household == auth()->user())
                                    <div wire:loading wire:target="hla">Processing...</div>
                                    <div wire:loading.remove wire:target="hla" class="custom-file">
                                        <label class="text-left custom-file-label" for="customFile">Choose file</label>
                                        <input type="file" class="custom-file-input" id="customFile" wire:model='hla'>
                                    </div>
                                    @error('hla')
                                        <span class='text-danger'>{{ $message }}</span>
                                    @enderror
                                    @else
                                    <div class='text-muted'>N/A</div>
                                    @endif
                                @endif
                            </dd>
                            <dt class='col-lg-5'>
                                By Tenant:
                            </dt>
                            <dd class='text-right col-lg-7'>
                                @if($property->hasMedia('tla'))
                                <a href='{{ $property->tla->getUrl() }}' target='_blank'>
                                    {{ $property->tla->name }}
                                    <br>
                                    ({{ $property->tla->human_readable_size }})
                                </a>
                                @elseif($tla)
                                <button class='btn btn-success' wire:click='uploadTla'>Upload</button>
                                @else
                                @role('tenant')
                                <div wire:loading wire:target="tla">Processing...</div>
                                <div wire:loading.remove wire:target="tla" class="custom-file">
                                    <label class="text-left custom-file-label" for="customFile">Choose file</label>
                                    <input type="file" class="custom-file-input" id="customFile" wire:model='tla'>
                                </div>
                                @error('tla')
                                    <span class='text-danger'>{{ $message }}</span>
                                @enderror
                                @else
                                <div class='text-muted'>N/A</div>
                                @endrole
                                @endif
                            </dd>
                        </dl>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @role('director')
    <div class="modal fade" id="changeTenant" tabindex="-1" role="dialog" aria-labelledby="changeTenantLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="changeTenantLabel">Change Tenant</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Tenant</label>
                    <select wire:model='tenant' class='form-control @error('tenant') is-invalid @enderror' required>
                        <option value='' disabled selected>Select an option</option>
                        @foreach($tenants as $ten)
                        <option value='{{ $ten->id }}' @if($property->tenant && $property->tenant->id == $ten->id) selected @endif>{{ $ten->name }}</option>
                        @endforeach
                    </select>
                    @error('tenant')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click='updateTenant'>Update</button>
            </div>
          </div>
        </div>
    </div>
    @endrole
    <script>
        window.addEventListener('closeModal', event=> {
            $("[data-dismiss=modal]").trigger({ type: "click" });
        })
    </script>
    @if($property->tenant_status && $property->household->id == auth()->id())
    <script>
        function payForProperty() {
            windowWidth = 500;
            windowHeight = 800;
            var left = (screen.width - windowWidth) / 2;
            var top = (screen.height - windowHeight) / 4;
            var myWindow = window.open("{{ route('pay',$property->id) }}",'_blank','width=' + windowWidth + ', height=' + windowHeight + ', top=' + top + ', left=' + left);
        }
    </script>
    @endif
</div>