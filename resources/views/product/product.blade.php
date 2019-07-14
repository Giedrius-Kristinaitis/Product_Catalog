@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>{{ $product->name }}</h1>

        <img src="{{ $product->image }}" alt="{{ $product->name }} illustration" width="256" />

        <p>Description:
            <p>
            {{ $product->description }}
            </p>
        </p>

        <p>Status: {{ $product->enabled ? 'enabled' : 'disabled' }}</p>

        <p>SKU: {{ $product->sku }}</p>

        <p>Base price: {{ number_format($product->base_price, 2) }} &euro;</p>

        <p>Applied discount: {{ number_format($product->applied_discount, 2) }} &euro;</p>

        <p>
            Final price: {{ number_format($product->calculated_price, 2) }} &euro;

            @if ($product->calculated_price_no_discount > $product->calculated_price)
                <s>{{ number_format($product->calculated_price_no_discount, 2) }} &euro;</s>
            @endif

            @if (setting('include_tax'))
                <small>({{ $product->tax_rate }}% tax rate included)</small>
            @endif
        </p>

        <p>Rating:
                @if ($product->rating >= 1)
                    {{ number_format($product->rating, 1) }}/5
                @else
                    no ratings
                @endif
        </p>
    </div>
@endsection