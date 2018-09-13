<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dish\StoreRequest;
use App\Http\Requests\Dish\UpdateRequest;
use App\Models\Dish;
use App\Services\ImageUploader\ImageUpload;
use App\Services\Repositories\CategoryRepository;
use App\Services\Repositories\DishRepository;
use App\Services\Repositories\IngredientRepository;
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

    /**
     * @param StoreRequest $request
     * @param ImageUpload $imageUploader
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, ImageUpload $imageUploader)
    {
        $dish = $this->dishRepository->create($request->all());
        $dish->ingredients()->attach($request->ingredient_id);

        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $dish);
        }

        return redirect()->route('dishes.index');
    }

    /**
     * @param Dish $dish
     * @param CategoryRepository $categoryRepository
     * @param IngredientRepository $ingredientRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Dish $dish, CategoryRepository $categoryRepository, IngredientRepository $ingredientRepository)
    {
        return view('admin.dishes.edit')->with([
                'dish' => $dish,
                'categories' => $categories = $categoryRepository->all(),
                'ingredients' => $ingredients = $ingredientRepository->all()
            ]);
    }

    /**
     * @param Dish $dish
     * @param UpdateRequest $request
     * @param ImageUpload $imageUploader
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Dish $dish , UpdateRequest $request, ImageUpload $imageUploader)
    {
        $updatedDish = $this->dishRepository->updateById($dish->getKey(), $request->input());
        $updatedDish->ingredients()->attach($request->ingredient_id);

        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $updatedDish);
        }

        return redirect()->route('dishes.index');
    }

    /**
     * @param Dish $dish
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Dish $dish)
    {
        $this->dishRepository->deleteById($dish->getKey());
        return redirect()->route('dishes.index');
    }
}
