<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-10">

        <header class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4 leading-tight tracking-tight">
                {{ $blog->title }}
            </h1>
            @if($request)
                <h1>Requete : </h1>
                <p>{{$request}}</p>
            @endif

            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full uppercase tracking-wide font-semibold mb-2">
                {{ $blog->type_demande->name ?? 'Non classé' }}
            </span>

            <div class="flex justify-center items-center space-x-2 text-gray-500 text-sm">
                <span>Par <a href="{{ route('users.show', $blog->user) }}" class="font-medium text-gray-900 hover:underline">{{ $blog->user->name }}</a></span>
                <span>&bull;</span>
                <time datetime="{{ $blog->created_at->toIso8601String() }}">
                    Publié le {{ $blog->created_at->format('d/m/Y') }}
                </time>
            </div>
        </header>

        <hr class="border-gray-200 my-8">

        <article class="prose prose-lg mx-auto text-gray-700 leading-relaxed">
            {{$blog->description}}
        </article>

        <div class="mt-10 border-t border-gray-200 pt-6 flex justify-between items-center">
            <a href="{{ route('publications.blogs') }}" class="text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center">
                &larr; Retour aux articles
            </a>

            @can('update-blog',$blog)
                <a href="#" class="text-gray-500 hover:text-gray-700 text-sm font-medium">Modifier cet article</a>
            @endcan
        </div>

        <div class="mt-12">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Commentaires</h3>

            @auth
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Ajouter un commentaire</h4>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-4">
                            <textarea
                                name="comment"
                                rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Écrivez votre commentaire ici..."
                                required></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Publier
                            </button>
                        </div>
                    </form>
                </div>
            @endauth

            <div class="space-y-6">
                @foreach($blog->commentaire as $comment)
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-bold text-gray-900">
                                <a href="{{ route('users.show', $comment->user) }}" class="hover:underline">{{$comment->user->name}}</a>
                            </h4>
                        </div>
                        <p class="text-gray-700">{{$comment->comment}}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
