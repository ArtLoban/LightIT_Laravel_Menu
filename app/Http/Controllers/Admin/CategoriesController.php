<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Services\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;
use App\Services\ImageUploader\ImageUpload;
use App\Services\Repositories\ImageRepository;

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
                        // GOOD EXAMPLE!!!
//                             dd($this->categoryRepository->find(6)->image->path);         //   GOOD EXAMPLE!!!
                            //  dd($this->categoryRepository->find(5)->image());           MorphOne
                            //  dd($this->categoryRepository->find(5)->images());          MorphMany
                            //  dd($this->categoryRepository->find(5)->image);       object Image
                            //  dd($this->categoryRepository->find(5)->image->path);  Доступ к свойству path
                        // GOOD EXAMPLE!!!

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, ImageRepository $imageRepository)
    {
        $category = $this->categoryRepository->create($request->all());
        $this->categoryRepository->saveImage($request, $category, $imageRepository);

        return redirect()->route('categories.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.categories.edit', ['category' => $this->categoryRepository->find($id)]);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, ImageRepository $imageRepository, $id)
    {
        $category = $this->categoryRepository->find($id);
        $category->update($request->all());
        $this->categoryRepository->saveImage($request, $category, $imageRepository);

        return redirect()->route('categories.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->categoryRepository->find($id)->delete();

        return redirect()->route('categories.index');
    }

}
