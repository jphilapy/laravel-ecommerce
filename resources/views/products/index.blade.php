@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="http://via.placeholder.com/400x400" alt="" class="img-thumbnail">
                    <div class="caption">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>{{ $product->name }}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>${{ $product->getPrice() }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="/cart/{{ $product->id }}" method="post">
                                    @csrf
                                    {{ method_field('PUT') }}

                                    <button class="btn btn-success">Add to cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        @endforeach
    </div>
</div>


@endsection
