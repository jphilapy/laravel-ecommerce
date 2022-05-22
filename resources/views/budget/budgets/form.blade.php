@csrf

<div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : ''  }}">
        <option value=""></option>
        @foreach($categories as $category)
            <option
                value="{{ $category->id }}" {{ $category->id == (old('category_id')  ?: $budget->category_id ) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    {{ $errors->has('category_id') ? 'Missing category' : ''  }}
</div>
<div class="form-group">
    <label for="amount">Amount</label>
    <input type="number" name="amount" class="form-control {{ $errors->has('amount') ? 'is-invalid' : ''  }}"
           value="{{ old('amount') ?: $budget->amount }}">
    {{ $errors->has('amount') ? 'Missing amount' : ''  }}
</div>

<div class="form-group">
    <label for="budget_date">Budget Date</label>
    <select name="budget_date" class="form-control {{ $errors->has('budget_date') ? 'is-invalid' : ''  }}">
        <option value=""></option>
        @foreach($months as $month)
            <option
                value="{{ $month }}" {{ $month == $budget->getMonth() ? 'selected' : '' }}>
                {{ $month }}
            </option>
        @endforeach
    </select>
    {{ $errors->has('category_id') ? 'Missing category' : ''  }}
</div>


<button class="btn btn-success" type="submit">{{ isset($buttonText) ? $buttonText : 'Save' }}</button>
