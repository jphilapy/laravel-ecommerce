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
                            @csrf

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''  }}" value="{{ old('description') }}">

                                {{ $errors->has('description') ? 'Missing description' : ''  }}
                            </div>

                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''  }}" value="{{ old('amount') }}">
                                {{ $errors->has('description') ? 'Missing amount' : ''  }}
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''  }}">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                {{ $errors->has('description') ? 'Missing category' : ''  }}
                            </div>

{{--                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">--}}
                            <button class="btn btn-success" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
