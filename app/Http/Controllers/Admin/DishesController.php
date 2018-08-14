<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Dish\StoreRequest;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Ingredient;
use App\Services\Repositories\DishRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DishesController extends Controller
{
    public function index(DishRepository $dishRepository)
    {
        return view('admin.dishes.index', ['dishes' => $dishRepository->all()]);
    }

    public function create()
    {
        $categories = Category::all();
        $ingredients = Ingredient::all();

        return view('admin.dishes.create', ['categories' => $categories, 'ingredients' => $ingredients]);
    }

    public function store(StoreRequest $request)
    {
        $dish = new Dish($request->all());
        $dish->save();

        return redirect()->route('dishes.index');
    }

    public function edit($id)
    {
        $dish = Dish::find($id);
        return view('admin.dishes.edit', ['dish' => $dish]);
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
