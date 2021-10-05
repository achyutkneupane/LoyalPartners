@section('title','Properties')
<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">All Residency Properties</h5>
                  <p class="card-text">
                    <table class="table table-hover">
                        <thead class='thead-dark'>
                        <tr class='text-center'>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Household Name</th>
                            <th scope="col">Tenant Name</th>
                            <th scope="col">Documents</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($rproperties as $property)
                            <tr>
                                <th scope="row" class='text-center'>
                                    {{ $loop->iteration }}
                                </th>
                                <td class='text-center'>
                                    <a href='{{ route('property',$property->id) }}'>
                                        {{ $property->title }}
                                    </a>
                                </td>
                                <td class='text-center'>{{ $property->household ? $property->household->name : 'N/A' }}</td>
                                <td class='text-center'>
                                    {{ $property->tenant ? $property->tenant->name : 'N/A' }}
                                </td>
                                <td class='text-center'>
                                    <a href='{{ $property->hla->getUrl() }}'>By Household Member</a><br>
                                    <a href='{{ $property->tla->getUrl() }}'>By Tenant</a>
                                </td>
                                <td class='text-center'>
                                    <button class='btn btn-success' data-toggle="modal" data-target="#propertyVerify{{ $property->id }}">Verify</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="6" class='text-center'>
                                    Not Succifient
                                </th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                  </p>
                  @if($lproperties->hasPages())
                  <div class="card-footer">
                    {!! $lproperties->links() !!}
                  </div>
                  @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">All Lease Properties</h5>
                  <p class="card-text">
                    <table class="table table-hover">
                        <thead class='thead-dark'>
                        <tr class='text-center'>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Household Name</th>
                            <th scope="col">Tenant Name</th>
                            <th scope="col">Documents</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($lproperties as $property)
                            <tr>
                                <th scope="row" class='text-center'>
                                    {{ $loop->iteration }}
                                </th>
                                <td class='text-center'>
                                    <a href='{{ route('property',$property->id) }}'>
                                        {{ $property->title }}
                                    </a>
                                </td>
                                <td class='text-center'>{{ $property->household ? $property->household->name : 'N/A' }}</td>
                                <td class='text-center'>
                                    {{ $property->tenant ? $property->tenant->name : 'N/A' }}
                                </td>
                                <td class='text-center'>
                                    <a href='{{ $property->hla->getUrl() }}'>By Household Member</a><br>
                                    <a href='{{ $property->tla->getUrl() }}'>By Tenant</a>
                                </td>
                                <td class='text-center'>
                                    <button class='btn btn-success' data-toggle="modal" data-target="#propertyVerify{{ $property->id }}">Verify</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="6" class='text-center'>
                                    Not Succifient
                                </th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                  </p>
                  @if($lproperties->hasPages())
                  <div class="card-footer">
                    {!! $lproperties->links() !!}
                  </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
    @foreach($lproperties as $prop)
    <div class="modal fade" id="propertyVerify{{ $prop->id }}" tabindex="-1" role="dialog" aria-labelledby="propertyVerify{{ $prop->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="propertyVerify{{ $prop->id }}Label">Verify {{ $prop->title }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                Are you sure you want to verify?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" wire:click='acceptProp({{ $prop->id }})' data-dismiss="modal">Verify</button>
              </div>
          </div>
        </div>
    </div>
    @endforeach
    @foreach($rproperties as $prop)
    <div class="modal fade" id="propertyVerify{{ $prop->id }}" tabindex="-1" role="dialog" aria-labelledby="propertyVerify{{ $prop->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="propertyVerify{{ $prop->id }}Label">Verify {{ $prop->title }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                Are you sure you want to verify?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" wire:click='acceptProp({{ $prop->id }})' data-dismiss="modal">Verify</button>
              </div>
          </div>
        </div>
    </div>
    @endforeach
    <script>
        window.addEventListener('closeModal', event=> {
            $("[data-dismiss=modal]").trigger({ type: "click" });
        })
    </script>
</div>