<?php

namespace App\Http\Controllers\Budget;

use App\Http\Controllers\Controller;
use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(Category $category)
    {
        if($category) {
            $transactions = Transaction::where('category_id', $category->id)->get();
        } else {
            $transactions = Transaction::all();
        }

        return view('budget.transactions.index', compact('transactions'));
    }
}
