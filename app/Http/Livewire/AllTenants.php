<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllTenants extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page = 1;
 
    protected $queryString = [
        'page' => ['except' => 1],
    ];
    public function render()
    {
        $tenants = User::where('type','tenant')->paginate(10);
        return view('livewire.all-tenants',compact('tenants'));
    }
}