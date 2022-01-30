<?php

namespace App\Http\Controllers\Budget;

use App\Http\Controllers\Controller;
use App\Models\Budget\Category;
use App\Models\Budget\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionsController extends Controller
{
    public function index(Category $category)
    {
        $transactions = Transaction::byCategory($category)->get();

        return view('budget.transactions.index', compact('transactions'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'category_id' => 'required'
        ]);

        if($validator->fails()){
            return response($validator->errors(), 422);
        }

        Transaction::create($request->all());
        return redirect('/budget/transactions');
    }
}
