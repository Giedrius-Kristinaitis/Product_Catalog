@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <a class="btn btn-primary" href="{{ route('product.create') }}" role="button">Create product</a>
        <span id="delete-button" class="btn btn-danger invisible ml-3" role="button">Delete selected</span>
    </div>

    <h3>Products</h3>

    <table class="table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Illustration</th>
                <th scope="col">Name</th>
                <th scope="col">Enabled</th>
                <th scope="col">SKU</th>
                <th scope="col">Base price</th>
                <th scope="col">Discount</th>
                <th scope="col">Calculated price</th>
                <th scope="col" colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        <input product="{{ $product->id }}" type="checkbox" class="deletion-checkbox" />
                    </td>
                    <td><img src="{{ $product->image }}" alt="{{ $product->name }} icon" width="128"/></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->enabled ? 'Yes' : 'No' }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ number_format($product->base_price, 2) }} &euro;</td>
                    <td>{{ number_format($product->discount, 2) }} &euro;</td>
                    <td>{{ number_format($product->calculated_price, 2) }} &euro;</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('product.edit', ['id' => $product->id]) }}" role="button">Edit</a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="{{ route('product.delete', ['id' => $product->id]) }}" role="button">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
