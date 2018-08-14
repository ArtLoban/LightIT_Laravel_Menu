<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Services\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return view('admin.categories.index', ['categories' => $this->categoryRepository->all()]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreRequest $request)
    {
        $this->categoryRepository->create($request->all());

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        return view('admin.categories.edit', ['category' => $this->categoryRepository->find($id)]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->categoryRepository->find($id)->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $this->categoryRepository->find($id)->delete();

        return redirect()->route('categories.index');
    }

}
