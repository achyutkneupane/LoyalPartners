@section('title', 'Unverified Users')
<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Unverified Users</h5>
                  <p class="card-text">
                    <table class="table table-hover">
                        <thead class='thead-dark'>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($unverifieds as $unverified)
                            <tr>
                                <th scope="row">
                                    {{ $loop->iteration }}
                                </th>
                                <td>
                                    <a href='{{ route('profile',$unverified->id) }}'>
                                        {{ $unverified->name }}
                                    </a>
                                </td>
                                <td>{{ $unverified->contact }}</td>
                                <td>
                                    {{ Str::title(str_replace('_', ' ', $unverified->type)) }}
                                </td>
                                <td>
                                    <button class='btn btn-success' data-toggle="modal" data-target="#userAccepted{{ $unverified->id }}">Verify</button>
                                    <button class='btn btn-danger' data-toggle="modal" data-target="#userRejected{{ $unverified->id }}">Reject</button>
                                </td>
                            </tr>
                            <div class="modal fade" id="userAccepted{{ $unverified->id }}" tabindex="-1" role="dialog" aria-labelledby="userAccepted{{ $unverified->id }}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="userAccepted{{ $unverified->id }}Label">Accept {{ $unverified->name }}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to accept {{ $unverified->name }}?
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-success" wire:click='acceptUser({{ $unverified->id }})' data-dismiss="modal">Accept</button>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <div class="modal fade" id="userRejected{{ $unverified->id }}" tabindex="-1" role="dialog" aria-labelledby="userRejected{{ $unverified->id }}Label" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="userRejected{{ $unverified->id }}Label">Reject {{ $unverified->name }}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <p>
                                          Are you sure you want to reject {{ $unverified->name }}'s request?
                                      </p>
                                      <strong>
                                          Reason for rejection:
                                      </strong>
                                      <div class='w-100'>
                                        <textarea rows='8' class='w-100' wire:model='reason'>
                                        </textarea>
                                      </div>
                                      @error('reason')
                                      <span class='text-danger'>{{ $message }}</span>
                                      @enderror
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                      <button type="button" class="btn btn-success" wire:click='rejectUser({{ $unverified->id }})'>Reject</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                  </p>
                  @if($unverifieds->hasPages())
                  <div class="card-footer">
                    {!! $unverifieds->links() !!}
                  </div>
                  @endif
                  {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Button</a> --}}
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