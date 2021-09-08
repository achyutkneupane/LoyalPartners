<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithFileUploads;

class ViewProperty extends Component
{
    use WithFileUploads;
    public $pid,$property,$rta,$la,$pb;
    public function mount($id)
    {
        $this->pid = $id;
        $this->property = Property::find($this->pid);
    }
    public function uploadRta()
    {
        $this->validate([
            'rta' => 'required'
        ]);
        $extension = $this->rta->extension();
        $path = 'property'.$this->property->id.'rta'.now()->timestamp.'.'.$extension;
        $this->property->addMedia($this->rta->getRealPath())
                    ->usingFileName($path)
                    ->usingName($path)
                    ->toMediaCollection('rta');
    }
    public function render()
    {
        return view('livewire.view-property');
    }
}
