<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Services\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', ['users' => $this->userRepository->all()]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreRequest $request)
    {
        $this->userRepository->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => $request['role_id'],
        ]);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        return view('admin.users.edit', ['user' => $this->userRepository->find($id)]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $user = User::find($id);

//        $this->validate($request, [
//            'name' => 'required|string|max:255',
//            'email' => [
//                'required',
//                'string',
//                'email',
//                'max:255',
//                Rule::unique('users')->ignore($user->id),
//            ],
//            'password' => 'nullable|string|min:6',
//            'role_id' => 'required'
//        ]);

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
        $this->userRepository->find($id)->delete();

        return redirect()->route('users.index');
    }
}
