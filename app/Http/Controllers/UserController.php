<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all(){
        $users = User::all();

        return view('groups.seeUsers',['users'=>$users]);
    }

    public function show(User $user){
        return view('groups.show_profile',['user'=>$user]);
    }
}
