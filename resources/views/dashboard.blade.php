@extends('layouts.app')

@section('content')
<div class="container">
    @include('alerts.success')

    <div class="row justify-content-center">
        <a class="btn btn-primary" href="{{ route('product.create') }}" role="button">Create product</a>
        <a href="#" onclick="return false;" id="delete-button" class="btn btn-danger invisible ml-3" role="button">Delete selected</a>
    </div>

    @if ($products->count() > 0)
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
                    <th scope="col">Individual discount</th>
                    <th scope="col">Calculated price</th>
                    <th scope="col" colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    @include('product.row', ['product' => $product])
                @endforeach
            </tbody>
        </table>

        {{ $products->links() }}
    @else
        <h3>No products</h3>
    @endif
</div>
@endsection

<script src="{{ asset('js/product/deleteMultiple.js') }}" defer></script>
