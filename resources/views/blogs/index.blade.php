<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-12">

        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-6 border-b pb-2">Blogs</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($blogs as $blog)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">
                            <a href="{{ route('publications.show', $blog) }}" class="hover:text-indigo-600 transition-colors">
                                {{$blog->title}}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{$blog->description}}</p>

                        <div class="text-sm text-gray-500 space-y-1">
                            <p>Créateur : <span class="font-medium text-gray-700">{{$blog->user->name}}</span></p>
                        </div>

                        @can('update-blog',$blog)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <a href="/blogs/{{ $blog->id }}/edit" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Edit post &rarr;</a>
                            </div>
                            <form action="/blogs/{{$blog->id}}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>

                            </form>
                        @endcan
                    </div>
                @empty
                    <p class="text-gray-500 italic">Aucun article de blog pour le moment.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $blogs->links() }}
            </div>
        </div>

        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-6 border-b pb-2">Questions / Demandes</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($questions as $question)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-6 hover:shadow-md transition-shadow relative">
                        <div class="absolute top-0 right-0 mt-4 mr-4">
                            <span class="h-3 w-3 rounded-full bg-orange-400 block" title="Question"></span>
                        </div>

                        <h2 class="text-xl font-bold text-gray-800 mb-2">
                            <a href="{{ route('publications.show', $question) }}" class="hover:text-indigo-600 transition-colors">
                                {{$question->title}}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{$question->description}}</p>

                        <div class="text-sm text-gray-500 space-y-1">
                            <p>Créateur : <span class="font-medium text-gray-700">{{$question->user->name}}</span></p>
                            <p>Catégorie : <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                {{$question->type_demande->name ?? 'Aucune'}}
                            </span></p>
                        </div>

                        @can('update-blog', $question)
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <a href="/blogs/{{ $question->id }}/edit" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Edit question &rarr;</a>
                            </div>
                            <form action="/blogs/{{$question->id}}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>

                            </form>
                        @endcan
                    </div>
                @empty
                    <p class="text-gray-500 italic">Aucune question sur le forum pour le moment.</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $questions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
