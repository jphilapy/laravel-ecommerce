@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Update Budget
                    </div>
                    <div class="card-body">
                        <form action="/budget/budgets/{{$budget->id}}" method="POST" class="requires-validation" novalidate>
                            {{method_field('PUT')}}
                            @include('budget.budgets.form', ['buttonText'=>'Update'])
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
