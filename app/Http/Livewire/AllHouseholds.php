<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllHouseholds extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page = 1;
 
    protected $queryString = [
        'page' => ['except' => 1],
    ];
    public function render()
    {
        $households = User::where('type','household_member')->paginate(10);
        return view('livewire.all-households',compact('households'));
    }
}