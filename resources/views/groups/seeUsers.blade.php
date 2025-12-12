<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Liste des Utilisateurs</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($users as $user)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-6 flex flex-col h-full">

                    <div class="mb-4">
                        <a href="{{ route('users.show', $user) }}" class="block">
                            <h1 class="text-xl font-bold text-gray-900 hover:text-indigo-600 transition-colors">
                                {{$user->name}}
                            </h1>
                        </a>

                        @if($user->group_id)
                            <h2 class="text-sm font-medium text-indigo-600 mt-1">Groupe ID : {{$user->group_id}}</h2>
                        @endif
                    </div>

                    <p class="text-gray-600 text-sm mb-4 flex-grow">{{$user->description}}</p>

                    <div class="border-t border-gray-100 pt-4 mt-auto">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Instruments</h3>
                        <div class="flex flex-wrap gap-2">
                            @forelse($user->instruments as $inst)
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                    {{$inst->name}}
                                </span>
                            @empty
                                <span class="text-xs text-gray-400 italic">Aucun instrument</span>
                            @endforelse
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
