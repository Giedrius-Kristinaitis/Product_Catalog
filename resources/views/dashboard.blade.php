@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <a class="btn btn-primary" href="{{ route('product.create') }}" role="button">Create product</a>
    </div>
</div>
@endsection
