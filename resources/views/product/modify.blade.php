@extends('layouts.app')

@section('content')
    <div class="container">
        @include('alerts.error')

        {!! form($form) !!}
    </div>
@endsection