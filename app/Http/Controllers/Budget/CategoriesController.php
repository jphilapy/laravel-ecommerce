<?php

namespace App\Http\Controllers\Budget;

use App\Http\Controllers\Controller;
use App\Models\Budget\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate();
        return view('budget.categories.index', compact('categories'));
    }
}
