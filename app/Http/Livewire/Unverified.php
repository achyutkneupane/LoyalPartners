<?php

namespace App\Http\Livewire;

use App\Mail\UserAccepted;
use App\Mail\UserRejected;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Unverified extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page = 1;
    public $reason;
 
    protected $queryString = [
        'page' => ['except' => 1],
    ];
    public function acceptUser($id)
    {
        $user = User::find($id);
        $user->verified = true;
        $user->save();
        Mail::to($user->email)
            ->send(new UserAccepted());
    }
    public function rejectUser($id)
    {
        $user = User::find($id);
        Mail::to($user->email)
            ->send(new UserRejected($this->reason));
            $this->dispatchBrowserEvent('closeModal');
    }
    public function render()
    {
        $unverifieds = User::where('verified',false)->paginate(10);
        return view('livewire.unverified',compact('unverifieds'));
    }
}
