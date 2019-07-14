<div class="card col-md-3 m-4 text-center">
    <div class="m-3">
        <img src="{{ $product->image }} " alt="{{ $product->name }} illustration" width="200"/>
    </div>

    <a href="{{ route('product', $product->id) }}"><h4>{{ $product->name }}</h4></a>

    <p>SKU: {{ $product->sku }}</p>

    <p>
        {{ number_format($product->calculated_price, 2) }} &euro;

        @if ($product->calculated_price_no_discount > $product->calculated_price)
            <s>{{ number_format($product->calculated_price_no_discount, 2) }} &euro;</s>
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