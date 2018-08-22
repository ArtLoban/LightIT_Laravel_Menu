<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dish\StoreRequest;
use App\Http\Requests\Dish\UpdateRequest;
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
//        dd($this->dishRepository->find(1)->ingredients());
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
     * @param ImageRepository $imageRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, ImageRepository $imageRepository)
    {
        $dish = $this->dishRepository->create($request->all());
        $this->dishRepository->find($dish->id)->ingredients()->attach($request->ingredient_id);
        $this->dishRepository->saveImage($request, $dish, $imageRepository);

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
        return view('admin.dishes.edit')
            ->with([
                'dish' => $this->dishRepository->find($id),
                'categories' => $categories = $categoryRepository->all(),
                'ingredients' => $ingredients = $ingredientRepository->all()
            ]);
    }

    public function update(UpdateRequest $request, ImageRepository $imageRepository, $id)
    {
        $dish = $this->dishRepository->find($id)->update($request->all());
        $this->dishRepository->find($id)->ingredients()->attach($request->ingredient_id);

//        $dish->update($request->all());

        $this->dishRepository->saveImage($request, $dish, $imageRepository);

        return redirect()->route('dishes.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->dishRepository->find($id)->delete();

        return redirect()->route('dishes.index');
    }
}
