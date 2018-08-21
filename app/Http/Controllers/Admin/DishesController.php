<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dish\StoreRequest;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Ingredient;
use App\Services\Repositories\CategoryRepository;
use App\Services\Repositories\DishRepository;
use App\Services\Repositories\ImageRepository;
use App\Services\Repositories\IngredientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DishesController extends Controller
{
    /**
     * @var DishRepository
     */
    private $dishRepository;

    /**
     * DishesController constructor.
     * @param DishRepository $dishRepository
     */
    public function __construct(DishRepository $dishRepository)
    {
        $this->dishRepository = $dishRepository;
    }

    /**
     * @param DishRepository $dishRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(DishRepository $dishRepository)
    {
        return view('admin.dishes.index', ['dishes' => $dishRepository->all()]);
    }

    /**
     * @param CategoryRepository $categoryRepository
     * @param IngredientRepository $ingredientRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CategoryRepository $categoryRepository, IngredientRepository $ingredientRepository)
    {
        $categories = $categoryRepository->all();
        $ingredients = $ingredientRepository->all();

        return view('admin.dishes.create', ['categories' => $categories, 'ingredients' => $ingredients]);
    }

    public function store(StoreRequest $request)
    {
        $dish = new Dish($request->all());
        $dish->save();

        return redirect()->route('dishes.index');
    }

    /**
     * @param CategoryRepository $categoryRepository
     * @param IngredientRepository $ingredientRepository
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CategoryRepository $categoryRepository, IngredientRepository $ingredientRepository, $id)
    {
        return view('admin.dishes.edit', [
            'dish' => $this->dishRepository->find($id),
            'categories' => $categories = $categoryRepository->all(),
            'ingredients' => $ingredients = $ingredientRepository->all()
            ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required|string']);
        $dish = Dish::find($id);
        $dish->update($request->all());

        return redirect()->route('dishes.index');
    }

    public function destroy($id)
    {
        Dish::find($id)->delete();

        return redirect()->route('dishes.index');
    }
}
