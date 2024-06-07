<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // Shows user list
    public function users(Request $request)
    {
        if (!Auth::check() || Auth::user()->is_admin != 1) {
            return redirect('/')->with('error', 'You do not have admin access.');
        }

        $query = User::query();

        $users = $query->paginate(10);

        return view('users', compact('users'));

    }

    public function searchUser(Request $request)
    {
        $searchQuery = trim($request->input('search'));
        $state = $request->input('state');
        $isAdmin = $request->input('admin');

        $query = User::query();

        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('email', 'like', "%{$searchQuery}%")
                    ->orWhere('phone', 'like', "%{$searchQuery}%");
            });
        }

        if ($state) {
            $query->where('state', $state);
        }

        if ($isAdmin) {
            $query->where('is_admin', true);
        }

        $users = $query->get();

        return view('ajax.user_search_results', compact('users'));
    }

    // Retrieve user data and display
    public function show(Request $request, User $id)
    {
        $partials = [];

        if (Auth::check() && Auth::user()->is_admin == 1 && Auth::user()->id !== $id->id) {

            $partials = ['profile.partials.update-profile-information-form', 'profile.partials.update-admin-form', 'profile.partials.delete-user-form'];

            return view('edit', [
                'user' => $id,
                'partials' => $partials,
            ]);
        } elseif (Auth::check() && Auth::user()->is_admin == 1) {
            $partials = ['profile.partials.update-profile-information-form', 'profile.partials.update-password-form', 'profile.partials.update-admin-form', 'profile.partials.delete-user-form'];

            return view('edit', [
                'user' => $id,
                'partials' => $partials,
            ]);
        } else {

            $partials = ['profile.partials.update-profile-information-form', 'profile.partials.update-password-form', 'profile.partials.delete-user-form'];

            if (Auth::check() && Auth::user()->id === $id->id) {
                return view('edit', [
                    'user' => $id,
                    'partials' => $partials,
                ]);
            } else {
                // Redirect or return an error message as needed
                abort(403, 'Unauthorized');
            }

        }
    }

    // Update the user's profile information.
    public function update(ProfileUpdateRequest $request, $id): RedirectResponse
    {

        $user = User::findOrFail($id);

        $user->fill($request->validated());

        $user->save();

        return Redirect::route('profile.show', ['id' => $id])->with('status', 'profile-updated');
    }

    public function updateAdmin(AdminUpdateRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $user->fill($request->validated());

        $user->save();

        return Redirect::route('profile.show', ['id' => $id])->with('status', 'rights-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = User::findOrFail($id);

        $user->delete();


        return Redirect::route('profile.users')->with('status', 'user-deleted');
    }

}
