<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public $userId,$user;
    public function mount($id = NULL)
    {
        $this->userId = $id ? $id : auth()->id();
        $this->user = User::find($this->userId);
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
