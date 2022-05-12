<?php

namespace App\Http\Controllers\Budget;

use App\Http\Controllers\Controller;
use App\Models\Budget\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::paginate();
        return view('budget.categories.index', compact('categories'));
    }

    public function store()
    {
        Category::create(request()->all());
        return redirect('/budget/categories');
    }
}
