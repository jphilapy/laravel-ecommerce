@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Create Category
                    </div>
                    <div class="card-body">
                        <form action="/budget/categories" method="POST" class="requires-validation" novalidate>
                            @include('budget.categories.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
