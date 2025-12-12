<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        $blogs = Publication::where('is_request', false)->with(['user', 'type_demande'])->get();
        $questions = Publication::where('is_request', true)->with(['user', 'type_demande'])->get();

        return view('blogs.index', [
            'blogs' => $blogs,
            'questions' => $questions
        ]);
    }

    public function addComment(Publication $publication, Request $request){
        Commentaire::create([
            'commment' => $request->input('comment'),
            'user_id' => auth()->id(),
        ]);
        return view('blogs.show',['blog' => $publication,'request' => $request]);
    }

    public function show(Publication $blog,Request $request){
        return view('blogs.show',['blog'=>$blog,'request' => $request]);
    }


}
