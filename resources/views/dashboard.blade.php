@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <a class="btn btn-primary" href="{{ route('product.create') }}" role="button">Create product</a>
        <a href="#" onclick="return false;" id="delete-button" class="btn btn-danger invisible ml-3" role="button">Delete selected</a>
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
                        <form action="/product/{{ $product->id }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input class="btn btn-primary" role="button" type="submit" name="submit" value="Edit"/>
                        </form>
                    </td>
                    <td>
                        <form action="/product/{{ $product->id }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input class="btn btn-danger" role="button" type="submit" name="submit" value="Delete"/>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<script src="{{ asset('js/product/deleteMultiple.js') }}" defer></script>
