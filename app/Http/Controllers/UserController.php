<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function all(){
        $users = User::all()->sortByDesc('created_at');

        return view('groups.seeUsers',['users'=>$users]);
    }

    public function show(User $user){
        return view('groups.show_profile',['user'=>$user]);
    }

    public function addtogroup(User $user){
        $user->group_id = Auth::user()->group_id;
        $user->save();
        return redirect()->route('users.index');
    }
}
