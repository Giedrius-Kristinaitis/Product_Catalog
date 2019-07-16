@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($products->count() > 0)
            <h3>Products</h3>

            <div class="row">
                @foreach ($products as $product)
                    @include('product.card', ['product' => $product])
                @endforeach
            </div>

            {{ $products->links() }}
        @else
            <h3>No products</h3>
        @endif
    </div>
@endsection
