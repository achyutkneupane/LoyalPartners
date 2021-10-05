<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class Properties extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title,$description,$purpose = '',$amount;
    public function addProperty()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'purpose' => 'required',
            'amount' => 'required'
        ]);
        Property::create([
            'title' => $this->title,
            'description' => $this->description,
            'purpose' => $this->purpose,
            'household_id' => auth()->id(),
            'price' => $this->amount,
        ]);
        $this->reset('purpose','title','description','amount');
        $this->dispatchBrowserEvent('closeModal');
    }
    public function render()
    {
        if(auth()->user()->hasRole('director'))
        {
            $properties = Property::with('household','tenant','media')->paginate(10);
        }
        else {
            $properties = Property::with('household','tenant','media')->whereHas('household',function($user) {
                $user->where('id',auth()->id());
            })->orwhereHas('tenant',function($user) {
                $user->where('id',auth()->id());
            })->paginate(10);
        }
        return view('livewire.properties',compact('properties'));
    }
}
