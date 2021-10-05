<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ViewProperty extends Component
{
    use WithFileUploads;
    public $pid,$property,$trta,$hrta,$hla,$tla,$pb,$tenants,$tenant='';
    public function mount($id)
    {
        $this->pid = $id;
    }
    public function uploadTrta()
    {
        $this->validate([
            'trta' => 'required'
        ]);
        $this->property->tenant()->associate(auth()->id());
        $this->property->save();
        $extension = $this->trta->extension();
        $path = 'property'.$this->property->id.'trta'.now()->timestamp.'.'.$extension;
        $this->property->addMedia($this->trta->getRealPath())
                        ->withCustomProperties(['uploader' => auth()->id()])
                        ->usingFileName($path)
                        ->usingName($path)
                        ->toMediaCollection('trta');

    }
    public function uploadHrta()
    {
        $this->validate([
            'hrta' => 'required'
        ]);
        $extension = $this->hrta->extension();
        $path = 'property'.$this->property->id.'hrta'.now()->timestamp.'.'.$extension;
        $this->property->addMedia($this->hrta->getRealPath())
                        ->withCustomProperties(['uploader' => auth()->id()])
                        ->usingFileName($path)
                        ->usingName($path)
                        ->toMediaCollection('hrta');

    }
    public function uploadTla()
    {
        $this->validate([
            'tla' => 'required'
        ]);
        $this->property->tenant()->associate(auth()->id());
        $this->property->save();
        $extension = $this->tla->extension();
        $path = 'property'.$this->property->id.'tla'.now()->timestamp.'.'.$extension;
        $this->property->addMedia($this->tla->getRealPath())
                        ->withCustomProperties(['uploader' => auth()->id()])
                        ->usingFileName($path)
                        ->usingName($path)
                        ->toMediaCollection('tla');

    }
    public function uploadHla()
    {
        $this->validate([
            'hla' => 'required'
        ]);
        $extension = $this->hla->extension();
        $path = 'property'.$this->property->id.'hla'.now()->timestamp.'.'.$extension;
        $this->property->addMedia($this->hla->getRealPath())
                        ->withCustomProperties(['uploader' => auth()->id()])
                        ->usingFileName($path)
                        ->usingName($path)
                        ->toMediaCollection('hla');

    }
    public function updateTenant()
    {
        $this->property->tenant()->associate($this->tenant);
        $this->property->clearMediaCollection($this->property->purpose == 'lease' ? 'tla' : 'trta');
        $this->property->save();
        $this->reset('tenant');
        $this->dispatchBrowserEvent('closeModal');
    }
    public function render()
    {
        $this->tenants = User::where('type','tenant')->get();
        $this->property = Property::find($this->pid);
        return view('livewire.view-property');
    }
}
