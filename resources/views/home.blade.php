@extends('layouts.myApp')

@section('nav')
<div class="container">
    <div class="row">
        @auth
        <div class="col-2 pt-3" style="background: #f8f9fa">
            <ul id="nvaPages" class="list-unstyled">
                <li id="customersLink" class="btn btn-block"><a class="" href="{{ route('customers.index') }}">Customers</a></li>
                <li id="productsLink" class="btn btn-block"><a href="{{ route('products.index') }}">Products</a></li>
                <li id="categoriesLink" class="btn btn-block"><a href="{{ route('categories.index') }}">Categories</a></li>
            </ul>
        </div>
        @endauth
        <div class="col-10">
            @if(is_path('home') || is_path("/") || is_path("layouts.myApp"))
                <div class="mx-auto display-2 text-secondary" style="width: 200px;">
                    Welcome
                </div>
            @endif

            @yield("content")
        </div>
    </div>
</div>
@endsection
