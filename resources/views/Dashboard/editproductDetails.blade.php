@extends('layouts.app')

@section('content')
    <h1>Edit Product Details </h1>

    <form action="{{ $productDetails ? route('edit-product-details', ['id' => $productDetails->id]) : '#' }}" method="POST">
    @csrf
    <!--  fields  -->
    <label for="ProductName">Product Name</label>
    <input type="text" id="ProductName" name="ProductName" value="{{ $productDetails ? $productDetails->ProductName : '' }}">
    <label for="color">Color</label>
    <input type="text" id="color" name="color" value="{{ $productDetails ? $productDetails->color : '' }}">
    <label for="price">Price</label>
    <input type="number" id="price" name="price" value="{{ $productDetails ? $productDetails->price : '' }}">
    <label for="qty">Quantity</label>
    <input type="number" id="qty" name="qty" value="{{ $productDetails ? $productDetails->qty : '' }}">
    <label for="description">Description</label>
    <textarea id="description" name="description">{{ $productDetails ? $productDetails->description : '' }}</textarea>
    <button type="submit">Save Changes</button>
</form>

@endsection
