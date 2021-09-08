<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;

class Properties extends Component
{
    public $title,$description;
    public function addProperty()
    {
        // dd($this->title,$this->description);
        $this->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        Property::create([
            'title' => $this->title,
            'description' => $this->description,
            'household_id' => auth()->id(),
        ]);
        $this->dispatchBrowserEvent('closeModal');
    }
    public function render()
    {
        $properties = Property::with('household','tenant','media')->whereHas('household',function($user) {
            $user->where('id',auth()->id());
        })->orwhereHas('tenant',function($user) {
            $user->where('id',auth()->id());
        })->paginate(10);
        return view('livewire.properties',compact('properties'));
    }
}
