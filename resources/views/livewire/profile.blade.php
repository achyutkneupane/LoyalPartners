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
                  <h5 class="card-title">Section Title</h5>
                  <p class="card-text">
                      This is a section where household details will be shown.
                  </p>
                  {{-- <a href="#" class="btn btn-primary">Button</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>