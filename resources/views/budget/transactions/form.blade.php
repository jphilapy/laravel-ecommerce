@csrf

<div class="form-group">
    <label for="description">Description</label>
    <input type="text" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''  }}"
           value="{{ old('description') ?: $transaction->description }}">

    {{ $errors->has('description') ? 'Missing description' : ''  }}
</div>

<div class="form-group">
    <label for="amount">Amount</label>
    <input type="number" name="amount" class="form-control {{ $errors->has('amount') ? 'is-invalid' : ''  }}"
           value="{{ old('amount') ?: $transaction->amount }}">
    {{ $errors->has('amount') ? 'Missing amount' : ''  }}
</div>

<div class="form-group">
    <label for="category_id">Category</label>
<<<<<<< HEAD
    <select name="category_id" class="form-control {{ $errors->has('description') ? 'is-invalid' : ''  }}">
        <option value=""></option>
        @foreach($categories as $category)
            <option
                value="{{ $category->id }}" {{ $category->id == (old('category_id') ?: $transaction->category_id )? 'selected' : '' }}>
=======
    <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : ''  }}">
        <option value=""></option>
        @foreach($categories as $category)
            <option
                value="{{ $category->id }}" {{ $category->id == (old('category_id')  ?: $transaction->category_id ) ? 'selected' : '' }}>
>>>>>>> tdd-laravel-budget
                {{ $category->name }}
            </option>
        @endforeach
    </select>
<<<<<<< HEAD
    {{ $errors->has('description') ? 'Missing category' : ''  }}
</div>

{{--                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">--}}
=======
    {{ $errors->has('category_id') ? 'Missing category' : ''  }}
</div>

>>>>>>> tdd-laravel-budget
<button class="btn btn-success" type="submit">{{ isset($buttonText) ? $buttonText : 'Save' }}</button>
