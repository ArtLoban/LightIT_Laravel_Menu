<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Services\ImageUploader\ImageUpload;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
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
     * @param ImageUpload $imageUploader
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, ImageUpload $imageUploader)
    {
        $user = $this->userRepository->create($request->all());
        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $user);
        }

        return redirect()->route('users.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * @param User $user
     * @param UpdateRequest $request
     * @param UserUpdateDataTransform $transformer
     * @param ImageUpload $imageUploader
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        User $user,
        UpdateRequest $request,
        UserUpdateDataTransform $transformer,
        ImageUpload $imageUploader
    ) {
        $specificUser = $this->userRepository
            ->updateById($user->getKey(), $transformer->transform($request->except('_token', '_method', 'updatedUserId')));

        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $specificUser);
        }

        return redirect()->route('users.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $this->userRepository->deleteById($user->getKey());
        return redirect()->route('users.index');
    }
}
