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
     * CategoriesController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * @param UpdateRequest $request
     * @param ImageUpload $imageUploader
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateRequest $request, ImageUpload $imageUploader)
    {
        $category = $this->categoryRepository->updateById($id, $request->input());
        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $category);
        }

        return redirect()->route('categories.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }

}
