<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Publication;
use App\Models\TypeDemande;
use App\Models\User;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        $blogs = Publication::where('is_request', false)
            ->with(['user', 'type_demande'])
            ->latest()
            ->paginate(10, ['*'], 'blogs_page');

        $questions = Publication::where('is_request', true)
            ->with(['user', 'type_demande'])
            ->latest()
            ->paginate(10, ['*'], 'questions_page');

        return view('blogs.index', [
            'blogs' => $blogs,
            'questions' => $questions
        ]);
    }

    public function addComment(Publication $blog, Request $request)
    {
        Commentaire::create([
            'comment' => $request->input('comment'),
            'publication_id' => $blog->id,
            'user_id' => auth()->id(),
        ]);
        return view('blogs.show', ['blog' => $blog]);
    }

    public function showNewDemande()
    {
        $type_demandes = TypeDemande::all();
        return view('blogs.newDemande', ['type_demandes' => $type_demandes]);
    }

    public function showNewPost()
    {
        $type_demandes = TypeDemande::all();
        return view('blogs.newPost', ['type_demandes' => $type_demandes]);
    }

    public function edit(Publication $blog){
        $type_demandes = TypeDemande::all();
        return view('blogs.edit', ['blog' => $blog,'type_demandes' => $type_demandes]);
    }

    public function update(Publication $blog){
        if(!request('title')) $titr = $blog->title;
        else $titr = request('title');
        if(!request('description')) $desc = $blog->description;
        else $desc = request('description');
        $blog->update([
            'title' => $titr,
            'description' => $desc,
            'demande_id'=> request('demande_id'),
        ]);
        return view('blogs.show', ['blog' => $blog]);
    }

    public function store(Request $request,User $user)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_request' => 'required|boolean',
            'demande_id' => 'exclude_if:is_request,0|required|exists:type_demandes,id',
        ]);

        Publication::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'is_request' => $validated['is_request'],
            'demande_id' => $validated['demande_id'] ?? null,

            'user_id' =>$user->id,
        ]);

        $user = $request->user();
        return view('groups.show_profile', ['user' => $user]);
    }

    public function show(Publication $blog, Request $request)
    {
        return view('blogs.show', ['blog' => $blog]);
    }


}
