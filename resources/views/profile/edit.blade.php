<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Bloc 1 : Informations de base (Nom/Email) --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- NOUVEAU BLOC : Description et Instruments --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Profil Musicien') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Mettez à jour votre description et vos instruments.") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            {{-- Champ Description --}}
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('description', $user->description) }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            {{-- Liste des Instruments (Checkbox) --}}
                            <div>
                                <h3 class="block font-medium text-sm text-gray-700 mb-2">Instruments</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach($allInstruments as $instrument)
                                        <div class="flex items-center">
                                            <input
                                                id="instrument_{{ $instrument->id }}"
                                                name="instruments[]"
                                                type="checkbox"
                                                value="{{ $instrument->id }}"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                {{-- On coche la case si l'utilisateur a déjà cet instrument --}}
                                                @if($user->instruments->contains($instrument->id)) checked @endif
                                            >
                                            <label for="instrument_{{ $instrument->id }}" class="ml-2 text-sm text-gray-600">
                                                {{ $instrument->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('instruments')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
