<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class PendingProperties extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title,$description,$purpose = '';
    public function acceptProp($propId)
    {
        $property = Property::find($propId);
        $property->tenant_status = true;
        $property->save();
        $this->dispatchBrowserEvent('closeModal');
    }
    public function render()
    {
        $lproperties = Property::where('purpose','lease')
                                ->where('tenant_status',false)
                                ->whereHas('media',function($media) {
                                    $media->where('collection_name','hla');
                                })->whereHas('media',function($media) {
                                    $media->where('collection_name','tla');
                                })->paginate(10);
        $rproperties = Property::where('purpose','residence')
                                ->where('tenant_status',false)
                                ->whereHas('media',function($media) {
                                    $media->where('collection_name','hrta');
                                })->whereHas('media',function($media) {
                                    $media->where('collection_name','trta');
                                })->paginate(10);
        return view('livewire.pending-properties',compact('rproperties','lproperties'));
    }
}
