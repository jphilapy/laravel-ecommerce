@csrf

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''  }}"
           value="{{ old('name') ?: $category->name }}">

    {{ $errors->has('name') ? 'Missing name' : ''  }}
</div>


<button class="btn btn-success" type="submit">{{ isset($buttonText) ? $buttonText : 'Save' }}</button>
