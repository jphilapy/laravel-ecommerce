<?php

namespace App\Http\Controllers\Budget;

use App\Http\Controllers\Controller;
use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Category $category)
    {

        $transactions = Transaction::byCategory($category)->where('user_id', Auth::user()->id)->paginate();
        return view('budget.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::all();
        $transaction = new Transaction();
        return view('budget.transactions.create', compact('categories', 'transaction'));
    }

    public function store()
    {

        $this->validate(request(), [
            'description'=>'required',
            'category_id' => 'required',
            'amount' => 'required|numeric'
        ]);


        Transaction::create(request()->all());

        return redirect('/budget/show-transactions');
    }

    public function update(Transaction $transaction)
    {

        $this->validate(request(), [
            'description'=>'required',
            'category_id' => 'required',
            'amount' => 'required|numeric'
        ]);


        $transaction->update(request()->all());

        return redirect('/budget/show-transactions');
    }

    public function edit(Transaction $transaction)
    {
        $categories = Category::all();
        return view('budget.transactions.edit', compact('categories','transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect('/budget/show-transactions');
    }
}
