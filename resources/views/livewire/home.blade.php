@section('title', 'Dashboard')

<div>
    <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fas fa-home"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Properties</span>
        <span class="info-box-number">{{ App\Models\Property::count() }}</span>
        <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
            Your properties: <b>{{ App\Models\Property::where('tenant_id',auth()->id())->orWhere('household_id',auth()->id())->count() }}</b>
        </span>
        </div>
    </div>
    <div class="info-box bg-success">
        <span class="info-box-icon"><i class="fas fa-file-alt"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Documents</span>
        <span class="info-box-number">{{ Spatie\MediaLibrary\MediaCollections\Models\Media::count() }}</span>
        <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
            Your documents: <b>{{ Spatie\MediaLibrary\MediaCollections\Models\Media::get()->filter(function($media) {
                    return $media->getCustomProperty('uploader') == auth()->id();
                })->count(); }}</b>
        </span>
        </div>
    </div>
    <div class="info-box bg-info">
        <span class="info-box-icon"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Users</span>
        <span class="info-box-number">{{ App\Models\User::count() }}</span>
        <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
            Tenants: <b>{{ App\Models\User::where('type','tenant')->count() }}</b> || Household: <b>{{ App\Models\User::where('type','household_member')->count() }}</b>
        </span>
        </div>
    </div>
    @role('director')
    <div class="info-box bg-warning">
        <span class="info-box-icon"><i class="fas fa-money-bill"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Amount Received</span>
        <span class="info-box-number">AUD {{ App\Models\Property::where('paid_at','!=',NULL)->sum('price') }}</span>
        <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
        </div>
        <span class="progress-description">
            Total properties amount: <b>{{ App\Models\Property::sum('price') }}</b>
        </span>
        </div>
    </div>
    @endrole
</div>