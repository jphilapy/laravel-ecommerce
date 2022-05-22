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
                          @include('budget.transactions.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
