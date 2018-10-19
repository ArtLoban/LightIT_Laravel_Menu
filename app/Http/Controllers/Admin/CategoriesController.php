<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Services\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;
use App\Services\ImageUploader\ImageUpload;

class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * Create a new CategoryRepository instance
     *
     * CategoriesController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
                        // GOOD EXAMPLE!
//                             dd($this->categoryRepository->find(5)->image->path);
                            //  dd($this->categoryRepository->find(5)->image());           MorphOne
                            //  dd($this->categoryRepository->find(5)->images());          MorphMany
                            //  dd($this->categoryRepository->find(5)->image);       object Image
                            //  dd($this->categoryRepository->find(5)->image->path);  Доступ к свойству path
                        // GOOD EXAMPLE!

        return view('admin.categories.index', ['categories' => $this->categoryRepository->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param ImageUpload $imageUploader
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, ImageUpload $imageUploader)
    {
        $category = $this->categoryRepository->create($request->all());
        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $category);
        }

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage
     *
     * @param Category $category
     * @param UpdateRequest $request
     * @param ImageUpload $imageUploader
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category, UpdateRequest $request, ImageUpload $imageUploader)
    {
        $updatedCategory = $this->categoryRepository->updateById($category->getKey(), $request->input());
        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $updatedCategory);
        }

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $this->categoryRepository->deleteById($category->getKey());
        return redirect()->route('categories.index');
    }
}
