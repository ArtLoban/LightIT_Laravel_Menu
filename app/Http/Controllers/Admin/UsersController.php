<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Services\InputTransform\UserUpdateDataTransform;
use App\Services\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UsersController constructor.
     * @param UserRepository $userRepository
     */
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
//        $user = $this->userRepository->getAllWith(['role']);
//        dd($user->first()->role->name);
        return view('admin.users.index', ['users' => $this->userRepository->getAllWith(['role'])]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->userRepository->create($request->all());

        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
//        dd($this->userRepository->find($id)->with('role')->get());
//        dd(get_class_methods($this->userRepository->find($id)->with('role')->get()));
//        return view('admin.users.edit', ['user' => $this->userRepository->find($id)]);
        return view('admin.users.edit', ['user' => $this->userRepository->find($id)]);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, UserUpdateDataTransform $transformer, $id)
    {
        $this->userRepository->updateById($id, $transformer->transform($request->except('_token', '_method', 'updatedUserId')));

        return redirect()->route('users.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->userRepository->find($id)->delete();

        return redirect()->route('users.index');
    }
}
