<?php

namespace App\Http\Controllers;

use App\Services\Repositories\CategoryRepository;
use App\Services\Repositories\DishRepository;

class MenuController extends Controller
{
    /**
     * Shows the the main page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryRepository $categoryRepository, DishRepository $dishRepository)
    {
        return view('menu.menu', ['categories' => $categoryRepository->all()]);
    }

    public function show($id, CategoryRepository $categoryRepository, DishRepository $dishRepository)
    {
        $category = $categoryRepository->find($id);
        $dishes = $dishRepository->getDishesByCategoryId($id);

        return view('menu.category', ['category' => $category, 'dishes' => $dishes]);
    }

    public function showDish($id, DishRepository $dishRepository)
    {
        $dish = $dishRepository->find($id);

        return view('menu.dish', ['dish' => $dish]);
    }
}
