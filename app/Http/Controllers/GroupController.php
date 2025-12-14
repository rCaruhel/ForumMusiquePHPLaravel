<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function create(){
        return view('group.create');
    }

    public function store(Request $request){
        $g = Groupe::create([
            'name' => $request->name,
        ]);
        $user = auth()->user();
        $user->group_id = $g->id;
        $user->save();
        return redirect()->route('users.index');
    }

    public function leave(Request $request){
        $user = $request->user();
        $user->group_id = null;
        $user->save();
        return redirect()->route('users.index');
    }
}
