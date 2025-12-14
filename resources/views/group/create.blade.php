<x-app-layout>
    <h1>Créer un groupe</h1>

    <form action="{{ route('group.store') }}" method="POST">
        @csrf
        <div class="mb-4">
                            <textarea
                                name="name"
                                rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Nom de votre groupe"
                                required></textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Créer le groupe
            </button>
        </div>
    </form>
</x-app-layout>
