@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form method="POST" action="{{ route('edit-product', ['id' => $product->id]) }}">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="ProductName">Product Name</label>
            <input type="text" id="ProductName" name="ProductName" value="{{ $product->ProductName }}">
        </div>

        <button type="submit">Save</button>
    </form>
    
@endsection