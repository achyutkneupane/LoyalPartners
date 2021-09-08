<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function allTenants()
    {
        return view('allTenants');
    }
    public function viewProfile($id)
    {
        return "Profile of ".$id;
    }
}
