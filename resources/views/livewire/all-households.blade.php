@section('title', 'Household Members')
<div class='container'>
    <div class='row'>
        <div class='col-lg-12'>
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">All Household Members</h5>
                  <p class="card-text">
                    <table class="table table-hover">
                        <thead class='thead-dark'>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($households as $household)
                            <tr>
                                <th scope="row">
                                    {{ $loop->iteration }}
                                </th>
                                <td>
                                    <a href='{{ route('profileView',$household->id) }}'>
                                        {{ $household->name }}
                                    </a>
                                </td>
                                <td>{{ $household->contact }}</td>
                                @if($household->verified)
                                <td class='badge badge-pill badge-success my-1'>Verified</td>
                                @else
                                <td class='badge badge-pill badge-danger my-1'>Not Verified</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </p>
                  <div class="card-footer">
                    {!! $households->links() !!}
                  </div>
                  {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Button</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>