<?php

namespace App\Http\Controllers\Admin;

use App\Services\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserRepository $repository)
    {
        return view('admin.users.index', ['users' => $repository->all()]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required'
            ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => $request['role_id'],
        ]);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
        // compact('user') or ['user' => $user]
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:6',
            'role_id' => 'required'
        ]);

        if ($request->get('password') == null) {
            $user->update($request->except('password'));
        } else {
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role_id' => $request['role_id'],
            ]);
        }

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }
}
