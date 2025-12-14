<x-app-layout>
    <h1>Nouvelle question</h1>

    <form action="{{ route('publications.store') }}" method="POST">
        @csrf

        <label for="title">Titre :</label><br>
        <input type="text" name="title" id="title" required>
        <br><br>

        <label for="demande_id">Catégorie :</label><br>
        <select name="demande_id" id="demande_id">
            @foreach($type_demandes as $type)
                <option value="{{ $type->id }}">{{ $type->name ?? $type->id }}</option>
            @endforeach
        </select>
        <br><br>

        <label for="description">Description :</label><br>
        <textarea name="description" id="description" rows="5" required></textarea>
        <br><br>
        <input type="hidden" name="is_request" value="1">



        <br><br>

        <button type="submit">Publier</button>
    </form>
</x-app-layout>
