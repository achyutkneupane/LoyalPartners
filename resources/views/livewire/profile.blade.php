@section('title',$user->name)
<div class='container-fluid'>
    <div class='row'>
        <div class='col-lg-4'>
            <div class="card">
                <div class="card-body">
                  {{-- <h5 class="card-title">{{ $user->name }}</h5> --}}
                  <p class="card-text">
                      <div class='text-center'>
                        <img src='https://classboxes.com//assets/img/user-img/user.png' class='rounded-circle border'>
                      </div>
                      <div class='d-flex flex-column mt-4'>
                        <dl class='row'>
                            <dt class='col-lg-3'>
                                Name:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                {{ $user->name }}
                            </dd>
                            <dt class='col-lg-3'>
                                Type:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                {{ Str::title(str_replace('_', ' ', $user->type)) }}
                            </dd>
                            <dt class='col-lg-3'>
                                Email:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                {{ $user->email }}
                            </dd>
                            <dt class='col-lg-3'>
                                Contact:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                {{ $user->contact }}
                            </dd>
                            <dt class='col-lg-3'>
                                Status:
                            </dt>
                            <dd class='col-lg-9 text-right'>
                                @if($user->verified)
                                <span class='badge badge-pill badge-success my-1'>Verified</span>
                                @else
                                <span class='badge badge-pill badge-danger my-1'>Not Verified</span>
                                @endif
                            </dd>
                        </dl>
                      </div>
                  </p>
                </div>
            </div>
        </div>
        <div class='col-lg-8'>
            <div class="card">
                <div class="card-body">
                @if(auth()->user()->type == 'director' || $user == auth()->user())
                    <h5 class="card-title">Uploaded Documents</h5>
                    <p class="card-text">
                        <table class="table table-hover">
                            <thead class='thead-dark'>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Type</th>
                                <th scope="col">Size</th>
                                <th scope="col">Property</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($medias as $media)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>
                                        <a href='{{ $media->getUrl() }}' target='_blank'>
                                            {{ $media->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($media->collection_name == 'trta')
                                        Residential Tenancy Agreement
                                        @elseif($media->collection_name == 'hrta')
                                        Residential Tenancy Agreement
                                        @elseif($media_collection_name == 'la')
                                        Lease Aggrement
                                        @elseif($media->collection_name == 'bp')
                                        Business Policy
                                        @endif
                                    </td>
                                    <td>
                                        {{ $media->human_readable_size }}
                                    </td>
                                    <td>
                                        <a href='{{ route('property',$media->model->id) }}'>
                                            {{ $media->model->title }}
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                <td colspan='5' class='text-center'>
                                    No Documents
                                </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </p>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Section Title</h5>
                    <p class="card-text">
                        Other Sections
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>