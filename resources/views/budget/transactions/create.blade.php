@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Create Transaction
                    </div>
                    <div class="card-body">
                        <form action="/budget/transactions" method="POST" class="requires-validation" novalidate>
<<<<<<< HEAD
                            @include('budget.transactions.form')
=======
                          @include('budget.transactions.form')
>>>>>>> tdd-laravel-budget
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
