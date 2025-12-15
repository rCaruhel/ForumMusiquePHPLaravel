<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6">
                <h1 class="text-3xl font-bold leading-6 text-gray-900">{{ $user->name }}</h1>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Membre depuis le {{ $user->created_at->format('d/m/Y') }}
                </p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">

                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Groupe</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if($user->group)
                                {{ $user->group->name }}
                            @else
                                <span class="text-gray-400 italic">N'est pas dans un groupe</span>
                            @endif
                        </dd>
                    </div>

                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Instruments</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul class="flex flex-wrap gap-2">
                                @forelse($user->instruments as $instrument)
                                    <li class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        {{ $instrument->name }}
                                    </li>
                                @empty
                                    <li class="text-gray-400 italic">Aucun instrument renseigné</li>
                                @endforelse
                            </ul>
                        </dd>
                    </div>

                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $user->description }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <hr class="border-gray-200 my-8">

        <h2 class="text-2xl font-bold text-gray-900 mb-6">Historique des publications</h2>

        <div class="space-y-6">
            @forelse($user->posts as $post)
                <div class="bg-white shadow sm:rounded-lg p-6 border-l-4 {{ $post->type_demande ? 'border-orange-400' : 'border-indigo-500' }}">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg font-medium text-gray-900">
                            <a href="{{ route('publications.show', $post) }}" class="hover:underline">{{ $post->title }}</a>
                        </h3>
                        <span class="text-xs text-gray-500 whitespace-nowrap ml-4">
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                    </div>

                    <div class="mt-1 mb-2">
                        @if($post->type_demande)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-800">[Demande]</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">[Blog]</span>
                        @endif
                    </div>

                    <p class="text-gray-600 mt-2 mb-3 text-sm">{{ $post->description }}</p>
                    @if($post->type_demande)
                        <p class="text-xs text-gray-500">
                            <em>Catégorie : {{ $post->type_demande->name}}</em>
                        </p>
                    @endif
                    <a href="/blogs/{{$post->id}}/edit">Modifier le poste</a>

                </div>
            @empty
                <div class="text-center py-6 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                    <p class="text-gray-500">Cet utilisateur n'a rien publié pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
