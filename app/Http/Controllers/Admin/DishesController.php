<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dish\StoreRequest;
use App\Http\Requests\Dish\UpdateRequest;
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

    /**
     * @param UpdateRequest $request
     * @param ImageUpload $imageUploader
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, ImageUpload $imageUploader, $id)
    {
        $dish = $this->dishRepository->updateById($id, $request->input());
        $dish->ingredients()->attach($request->ingredient_id);

        if ($request->has('image')) {
            $imageUploader->store($request->file('image'), $dish);
        }

        return redirect()->route('dishes.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->dishRepository->deleteById($id);

        return redirect()->route('dishes.index');
    }
}
