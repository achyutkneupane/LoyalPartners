<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;

class CompletePayment extends Component
{
    public $property,$paymentDone;
    public $mm,$yy,$cvc,$zip,$pname,$amount,$card_number;
    public function mount($pid)
    {
        $this->property = Property::with('tenant','household')->find($pid);
    }
    public function proceedPayment()
    {
        if(!$this->paymentDone)
        {
            $this->validate([
                'pname' => 'required',
                'amount' => 'required',
                'card_number' => 'required',
            ]);
            if(!!!$this->zip || !!!$this->mm || !!!$this->yy || !!!$this->cvc);
            {
                $this->addError('credit','Enter All Card Details');
            }
            $this->property->paid_at = now();
            $this->property->save();
        }
    }
    public function render()
    {
        $this->pname = $this->property->tenant->name;
        $this->amount = $this->property->price;
        $this->paymentDone = !!$this->property->paid_at;
        return view('livewire.complete-payment');
    }
}
