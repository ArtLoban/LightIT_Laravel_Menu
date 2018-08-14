<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Ingredient\StoreRequest;
use App\Http\Requests\Ingredient\UpdateRequest;
use App\Services\Repositories\IngredientRepository;
use App\Http\Controllers\Controller;

class IngredientsController extends Controller
{
    private $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function index()
    {
        return view('admin.ingredients.index', ['ingredients' => $this->ingredientRepository->all()]);
    }

    public function create()
    {
        return view('admin.ingredients.create');
    }

    public function store(StoreRequest $request)
    {
        $this->ingredientRepository->create($request->all());

        return redirect()->route('ingredients.index');
    }

    public function edit($id)
    {
        return view('admin.ingredients.edit', ['ingredient' => $this->ingredientRepository->find($id)]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->ingredientRepository->find($id)->update($request->all());

        return redirect()->route('ingredients.index');
    }

    public function destroy($id)
    {
        $this->ingredientRepository->find($id)->delete();

        return redirect()->route('ingredients.index');
    }


}
