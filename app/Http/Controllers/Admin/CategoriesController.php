<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => '',
            'category_id' => '',
            'price' => '',
            'weight' => '',
            'image' => '',
        ]);

        $category = new Category($request->all());
        $category->save();

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['name' => 'required']);
        $category = Category::find($id);
        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->route('categories.index');
    }

}
