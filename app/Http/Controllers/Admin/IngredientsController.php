<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Ingredient\StoreRequest;
use App\Http\Requests\Ingredient\UpdateRequest;
use App\Services\ImageUploader\ImageUpload;
use App\Services\Repositories\IngredientRepository;
use App\Http\Controllers\Controller;

class IngredientsController extends Controller
{
    /**
     * @var IngredientRepository
     */
    private $ingredientRepository;

    /**
     * IngredientsController constructor.
     * @param IngredientRepository $ingredientRepository
     */
    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.ingredients.index', ['ingredients' => $this->ingredientRepository->all()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.ingredients.create');
    }

    /**
     * @param StoreRequest $request
     * @param ImageUpload $imageUploader
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, ImageUpload $imageUploader)
    {
        $ingredient = $this->ingredientRepository->create($request->all());
        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $ingredient);
        }

        return redirect()->route('ingredients.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.ingredients.edit', ['ingredient' => $this->ingredientRepository->find($id)]);
    }

    /**
     * @param UpdateRequest $request
     * @param ImageUpload $imageUploader
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, ImageUpload $imageUploader, $id)
    {
        $ingredient = $this->ingredientRepository->updateById($id, $request->input());
        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $ingredient);
        }

        return redirect()->route('ingredients.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->ingredientRepository->deleteById($id);

        return redirect()->route('ingredients.index');
    }


}
