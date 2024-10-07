<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $roles = Role::all()->toArray();
        $users = User::all();
        return view('dashboard')
            ->with('users', $users)
            ->with('roles', $roles);
    }
}
