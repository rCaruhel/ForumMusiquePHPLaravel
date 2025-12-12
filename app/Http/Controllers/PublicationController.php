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

    public function addComment(Publication $blog, Request $request){
        Commentaire::create([
            'comment' => $request->input('comment'),
            'publication_id' => $blog->id,
            'user_id' => auth()->id(),
        ]);
        return view('blogs.show', ['blog' => $blog]);
    }

    public function show(Publication $blog,Request $request){
        return view('blogs.show',['blog'=>$blog]);
    }


}
