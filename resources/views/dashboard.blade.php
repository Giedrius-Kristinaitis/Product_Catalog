@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <a class="btn btn-primary" href="{{ route('product.create') }}" role="button">Create product</a>
    </div>

    <h3>Products</h3>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Illustration</th>
                <th scope="col">Name</th>
                <th scope="col">Enabled</th>
                <th scope="col">SKU</th>
                <th scope="col">Base price</th>
                <th scope="col">Discount</th>
                <th scope="col">Calculated price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><img src="{{ $product->image }}" alt="{{ $product->name }} icon" width="128"/></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->enabled ? 'Yes' : 'No' }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ number_format($product->base_price, 2) }} &euro;</td>
                    <td>{{ number_format($product->discount, 2) }} &euro;</td>
                    <td>{{ number_format($product->calculated_price, 2) }} &euro;</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
