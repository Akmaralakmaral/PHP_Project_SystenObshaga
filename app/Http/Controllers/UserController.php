<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

   public function updateRole(User $user, Request $request): RedirectResponse
    {
        $newRole = $request->input('role');

        $user->user_role = $newRole;
        $user->save();

        return redirect()->route('users')->with('success', 'User role updated successfully.');
    }

    public function showUsers()
    {
        $users = User::all();
        $roles = User::distinct('user_role')->pluck('user_role');
        return view('admin.users', compact('users', 'roles'));
    }

    public function destroy(User $user)
    {
        // Ваш код для удаления пользователя
        $user->delete();

        return redirect()->route('users')->with('success', 'Пользователь успешно удален');
    }
}
