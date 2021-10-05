@section('title', 'Documents')
<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Business Policy</h5>
                  <p class="card-text">
                    <table class="table">
                        <tbody>
                            @if($bp)
                            <tr>
                                <th scope="row" class='text-center'>
                                    <a href='{{ $bp->getUrl() }}' target='_blank'>View Business Policy</a>
                                </th>
                            </tr>
                            @role('director')
                            <tr>
                                <th class='text-center'>
                                    <button class='btn btn-warning' data-toggle="modal" data-target="#editBP">Edit</button>
                                    <button class='btn btn-danger' data-toggle="modal" data-target="#deleteBP">Delete</button>
                                </th>
                            </tr>
                            @endrole
                            @else
                            <tr>
                                <td class='text-center text-uppercase text-bold'>
                                    Business Policy Not Uploaded
                                </td>
                            </tr>
                            @role('director')
                            <tr>
                                <th class='text-center'>
                                    <button class='btn btn-link text-dark font-weight-bold' data-toggle="modal" data-target="#addBP">
                                        + Add
                                    </button>
                                </th>
                            </tr>
                            @endrole
                            @endif
                        </tbody>
                    </table>
                  </p>
                </div>
            </div>
        </div>
        <div class='col-lg-12'>
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Documents</h5>
                  <p class="card-text">
                    <table class="table table-hover">
                        <thead class='thead-dark'>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Size</th>
                                <th scope="col">Uploaded</th>
                                @role('director')
                                <th scope="col">Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documents as $doc)
                            <tr>
                                <th scope="row">
                                    {{ $loop->iteration }}
                                </th>
                                <td>
                                    <a href='{{ $doc->getUrl() }}' target='_blank'>{{ $doc->getCustomProperty('docTitle') }}</a>
                                </td>
                                <td>
                                    {{ $doc->human_readable_size }}
                                </td>
                                <td>
                                    {{ $doc->created_at->diffForHumans() }}
                                </td>
                                @role('director')
                                <td>
                                    <button class='btn btn-warning' wire:click='editDoc({{ $doc->id }})'>Edit</button>
                                    <button class='btn btn-danger' wire:click='deleteDoc({{ $doc->id }})'>Delete</button>
                                </td>
                                @endrole
                            </tr>
                            @empty
                            <tr>
                                @role('director')
                                <td colspan='5' class='text-center text-uppercase text-bold'>
                                @else
                                <td colspan='4' class='text-center text-uppercase text-bold'>
                                @endrole
                                    No Documents Uploaded
                                </td>
                            </tr>
                            @endforelse
                            @role('director')
                            <tr>
                                <th colspan='5' class='text-center'>
                                    <button class='btn btn-link text-dark font-weight-bold' data-toggle="modal" data-target="#addDocuments">
                                        + Add
                                    </button>
                                </th>
                            </tr>
                            @endrole
                        </tbody>
                    </table>
                  </p>
                  @if($documents->hasPages())
                  <div class="card-footer">
                    {!! $documents->links() !!}
                  </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
    @role('director')
    <div class="modal fade" id="addDocuments" tabindex="-1" role="dialog" aria-labelledby="addDocumentsLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addDocumentsLabel">Add Document</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Document Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Document Title" wire:model.defer='title' required>
                    @error('title')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Upload</label>
                    <br>
                    @if($document)
                    Processed. Click on Add button.
                    @else
                        <div wire:loading wire:target="document">Processing...</div>
                        <div wire:loading.remove wire:target="document" class="custom-file">
                            <label class="custom-file-label text-left" for="customFile">Choose file</label>
                            <input type="file" class="custom-file-input" id="customFile" wire:model='document'>
                        </div>
                    @endif
                    @error('document')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click='uploadDocument'>Add</button>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="editDoc" tabindex="-1" role="dialog" aria-labelledby="editDocLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editDocLabel">Edit Document</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Document Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Document Title" wire:model.defer='title' required>
                    @error('title')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Upload</label>
                    <br>
                    @if($document)
                    Processed. Click on Edit button.
                    @else
                        <div wire:loading wire:target="document">Processing...</div>
                        <div wire:loading.remove wire:target="document" class="custom-file">
                            <label class="custom-file-label text-left" for="customFile">Choose file</label>
                            <input type="file" class="custom-file-input" id="customFile" wire:model='document'>
                        </div>
                    @endif
                    @error('document')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click='editDocument'>Edit</button>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="deleteDoc" tabindex="-1" role="dialog" aria-labelledby="deleteDocLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteDocLabel">Delete Document</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                Do you want to delete {{ $deleteFile ? $deleteFile->getCustomProperty('docTitle') : '' }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click='deleteDocument'>Delete</button>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="addBP" tabindex="-1" role="dialog" aria-labelledby="addBPLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addBPLabel">Add Business Policy</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="description">Upload</label>
                    <br>
                    @if($newBP)
                    Processed. Click on Add button.
                    @else
                        <div wire:loading wire:target="newBP">Processing...</div>
                        <div wire:loading.remove wire:target="newBP" class="custom-file">
                            <label class="custom-file-label text-left" for="customFile">Choose file</label>
                            <input type="file" class="custom-file-input" id="customFile" wire:model='newBP'>
                        </div>
                    @endif
                    @error('newBP')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click='uploadBP'>Add</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="editBP" tabindex="-1" role="dialog" aria-labelledby="editBPLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editBPLabel">Edit Business Policy</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="description">Upload</label>
                    <br>
                    @if($newBP)
                    Processed. Click on Edit button.
                    @else
                        <div wire:loading wire:target="newBP">Processing...</div>
                        <div wire:loading.remove wire:target="newBP" class="custom-file">
                            <label class="custom-file-label text-left" for="customFile">Choose file</label>
                            <input type="file" class="custom-file-input" id="customFile" wire:model='newBP'>
                        </div>
                    @endif
                    @error('newBP')
                        <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click='editBP'>Edit</button>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="deleteBP" tabindex="-1" role="dialog" aria-labelledby="deleteBPLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteBPLabel">Delete Business Policy</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                Do you want to delete Business Policy?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" wire:click='deleteBP'>Delete</button>
            </div>
          </div>
        </div>
    </div>
    <script>
        window.addEventListener('closeModal', event=> {
            $("[data-dismiss=modal]").trigger({ type: "click" });
        });
        window.addEventListener('editDocModal', event=> {
            $("#editDoc").modal('show');
        });
        window.addEventListener('deleteDocModal', event=> {
            $("#deleteDoc").modal('show');
        });
    </script>
    @endrole
</div>