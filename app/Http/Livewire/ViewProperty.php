<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ViewProperty extends Component
{
    use WithFileUploads;
    public $pid,$property,$trta,$hrta,$la,$pb;
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
    public function render()
    {
        $this->property = Property::find($this->pid);
        return view('livewire.view-property');
    }
}
