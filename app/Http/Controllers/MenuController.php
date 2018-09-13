<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use App\Services\Repositories\CategoryRepository;
use App\Services\Repositories\DishRepository;

class MenuController extends Controller
{
    /**
     * Shows the the main page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryRepository $categoryRepository)
    {
        return view('menu.menu', ['categories' => $categoryRepository->all()]);
    }

    /**
     * Display the specified categoty and all it's dishes.
     *
     * @param Category $category
     * @param DishRepository $dishRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category, DishRepository $dishRepository)
    {
        $dishes = $dishRepository->getDishesByCategoryId($category->getKey());

        return view('menu.category', ['category' => $category, 'dishes' => $dishes]);
    }

    /**
     * Display the specified dish.
     *
     * @param Dish $dish
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDish(Dish $dish)
    {
        return view('menu.dish', ['dish' => $dish]);
    }
}
