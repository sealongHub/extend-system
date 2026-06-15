<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        return $query->get();
    }

    public function expenseCategory(){
        $query = Category::query()->where('type','expense');
        return $query->get();
    }
    
    public function incomeCategory(){
        $query = Category::query()->where('type','income');
        return $query->get();
    }

    public function savingCategory(){
        $query = Category::query()->where('type','saving');
        return $query->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'type' => 'required|in:income,expense,saving',
        ]);

        return Category::create($validated);
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'type' => 'sometimes|in:income,expense,saving',
        ]);

        $category->update($validated);
        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
