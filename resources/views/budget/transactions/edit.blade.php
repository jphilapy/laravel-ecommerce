@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Update Transaction
                    </div>
                    <div class="card-body">
<<<<<<< HEAD
                        <form action="/budget/transactions/{{ $transaction->id }}" method="POST" class="requires-validation" novalidate>
                           {{ method_field('PUT') }}
=======
                        <form action="/budget/transactions/{{$transaction->id}}" method="POST" class="requires-validation" novalidate>
                            {{method_field('PUT')}}
>>>>>>> tdd-laravel-budget
                            @include('budget.transactions.form', ['buttonText'=>'Update'])
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
