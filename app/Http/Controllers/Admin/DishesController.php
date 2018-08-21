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

    public function store(StoreRequest $request, ImageRepository $imageRepository)
    {
//        dd($request->ingredient_id);
        $dish = $this->dishRepository->create($request->all());
//        dd($dish->ingredients());

       // $dish->ingredients()->createMany([$request->ingredient_id]);

//        $post = App\Post::find(1);
//
//        $post->comments()->createMany([
//            [
//                'message' => 'A new comment.',
//            ],
//            [
//                'message' => 'Another new comment.',
//            ],
//        ]);


        if($request->hasFile('image')) {
            $data = $imageRepository->handleImage($dish, $request);
            $imageRepository->create($data);
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

    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required|string']);
        $dish = Dish::find($id);
        $dish->update($request->all());

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
