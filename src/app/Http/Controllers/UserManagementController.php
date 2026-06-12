<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(20);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => (bool) ($validated['is_admin'] ?? false),
            'role' => (bool) ($validated['is_admin'] ?? false) ? 'admin' : 'worker',
        ]);

        return redirect()->route('users.index')->with('status', 'アカウントを作成しました。');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->is_admin = (bool) ($validated['is_admin'] ?? false);
        $user->role = $user->is_admin ? 'admin' : 'worker';

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('status', 'アカウントを更新しました。');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('status', '自分自身のアカウントは削除できません。');
        }

        $user->delete();

        return redirect()->route('users.index')->with('status', 'アカウントを削除しました。');
    }
}
