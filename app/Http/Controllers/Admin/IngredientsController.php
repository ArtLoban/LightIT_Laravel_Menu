<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IngredientsController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();

        return view('admin.ingredients.index', ['ingredients' => $ingredients]);
    }

    public function create()
    {
        return view('admin.ingredients.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string']);
        $ingredient = new Ingredient($request->all());
        $ingredient->save();

        return redirect()->route('ingredients.index');
    }

    public function edit($id)
    {
        $ingredient = Ingredient::find($id);
        return view('admin.ingredients.edit', ['ingredient' => $ingredient]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required|string']);
        $ingredient = Ingredient::find($id);
        $ingredient->update($request->all());

        return redirect()->route('ingredients.index');
    }

    public function destroy($id)
    {
        Ingredient::find($id)->delete();

        return redirect()->route('ingredients.index');
    }


}
