<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Ingredient\StoreRequest;
use App\Http\Requests\Ingredient\UpdateRequest;
use App\Models\Ingredient;
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
     * @param Ingredient $ingredient
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Ingredient $ingredient)
    {
        return view('admin.ingredients.edit', ['ingredient' => $ingredient]);
    }

    /**
     * @param Ingredient $ingredient
     * @param UpdateRequest $request
     * @param ImageUpload $imageUploader
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Ingredient $ingredient, UpdateRequest $request, ImageUpload $imageUploader)
    {
        $updatedIngredient = $this->ingredientRepository->updateById($ingredient->getKey(), $request->input());
        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $updatedIngredient);
        }

        return redirect()->route('ingredients.index');
    }

    /**
     * @param Ingredient $ingredient
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Ingredient $ingredient)
    {
        $this->ingredientRepository->deleteById($ingredient->getKey());
        return redirect()->route('ingredients.index');
    }
}
