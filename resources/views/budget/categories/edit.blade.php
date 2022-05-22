@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Update Category
                    </div>
                    <div class="card-body">
                        <form action="/budget/categories/{{ $category->slug }}" method="POST" class="requires-validation" novalidate>
                           {{method_field('PUT')}}
                            @include('budget.categories.form', ['buttonText'=>'Update'])
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
