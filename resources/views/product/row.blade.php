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
        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary" role="button">Edit</a>
    </td>
    <td>
        <form action="/product/{{ $product->id }}" method="POST">
            @csrf
            @method('DELETE')

            <input class="btn btn-danger" role="button" type="submit" name="submit" value="Delete"/>
        </form>
    </td>
</tr>