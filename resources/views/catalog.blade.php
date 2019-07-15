@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Products</h3>

        <div class="row">
            @foreach ($products as $product)
                @include('product.card', ['product' => $product])
            @endforeach
        </div>

        {{ $products->links() }}
    </div>
@endsection
