<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Instrument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // On récupère tous les instruments pour les afficher dans la liste
        $allInstruments = Instrument::all();

        return view('profile.edit', [
            'user' => $request->user(),
            'allInstruments' => $allInstruments, // On passe la variable à la vue
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Remplit name, email, et description (si dans $fillable)
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Gestion des instruments (Many-to-Many)
        // La méthode sync met à jour les liens : ajoute les nouveaux, supprime les anciens
        if ($request->has('instruments')) {
            $user->instruments()->sync($request->validated()['instruments']);
        } else {
            // Si aucun instrument coché, on détache tout (cas où l'utilisateur décoche tout)
            $user->instruments()->detach();
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
