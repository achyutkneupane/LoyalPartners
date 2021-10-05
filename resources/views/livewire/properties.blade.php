@section('title','Properties')
<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">All Properties</h5>
                  <p class="card-text">
                    <table class="table table-hover">
                        <thead class='thead-dark'>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Household Name</th>
                            <th scope="col">Tenant Name</th>
                            <th scope="col">Purpose</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Documents</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($properties as $property)
                            <tr>
                                <th scope="row">
                                    {{ $loop->iteration }}
                                </th>
                                <td>
                                    <a href='{{ route('property',$property->id) }}'>
                                        {{ $property->title }}
                                    </a>
                                </td>
                                <td class='text-center'>{{ $property->household ? $property->household->name : 'N/A' }}</td>
                                <td class='text-center'>
                                    {{ $property->tenant ? $property->tenant->name : 'N/A' }}
                                </td>
                                <td>{{ $property->purpose == 'lease' ? 'Lease' : 'Residency' }}</td>
                                <td>AUD <b>{{ $property->price }}</b></td>
                                <td>{{ $property->media->count() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="7" class='text-center'>
                                    No Entries
                                </th>
                            </tr>
                            @endforelse
                            @role('household_member|director')
                            <tr>
                                <th colspan="7" class='text-center'>
                                    <button class='btn btn-link text-dark font-weight-bold' data-toggle="modal" data-target="#addProperty">
                                        + Add
                                    </button>
                                </th>
                            </tr>
                            @endrole
                        </tbody>
                    </table>
                  </p>
                  @if($properties->hasPages())
                  <div class="card-footer">
                    {!! $properties->links() !!}
                  </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addProperty" tabindex="-1" role="dialog" aria-labelledby="addPropertyLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addPropertyLabel">Add Property</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Property Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Property Title" wire:model.defer='title' required>
                    @error('title')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Purpose</label>
                    
                    <select wire:model='purpose' class='form-control @error('purpose') is-invalid @enderror' required>
                        <option value='' disabled selected>Select an option</option>
                        <option value='lease' @if($purpose == 'lease') selected @endif>Lease</option>
                        <option value='residence' @if($purpose == 'residence') selected @endif>Tenant Residency</option>
                    </select>
                    @error('purpose')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title">Amount</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">AUD</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroupAmount" placeholder="Property Price" wire:model.defer='amount' required>
                    </div>
                    @error('amount')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea rows='5' class='form-control' wire:model.defer='description'></textarea>
                    @error('description')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click='addProperty'>Add</button>
            </div>
          </div>
        </div>
    </div>
    <script>
        window.addEventListener('closeModal', event=> {
            $("[data-dismiss=modal]").trigger({ type: "click" });
        })
    </script>
</div>