<x-app-layout>
    <h1>Nouveau Post</h1>

    <form action="{{ route('publications.store') }}" method="POST">
        @csrf

        <label for="title">Titre :</label><br>
        <input type="text" name="title" id="title" required>
        <br><br>

        <input type="hidden" name="is_request" value="0">

        <label for="description">Description :</label><br>
        <textarea name="description" id="description" rows="5" required></textarea>
        <br><br>

        <button type="submit">Publier</button>
    </form>
</x-app-layout>
