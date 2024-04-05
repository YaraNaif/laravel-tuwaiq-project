@extends('layouts.base')

@section('content')
<div class="container">

<!-- Search Bar -->

<form action="{{ route('get-products') }}" method="get">


        <div class="input-group mt-5">
        <input type="text" class="form-control" placeholder="Search for products" id="productSearch" name="searchTerm">

            <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
        </div>
        </form>

        <!-- If search was performed and no products were found, display a message -->
@if ($products->isEmpty())
        <div class="alert alert-danger">
        <ul>
            <li>There are no products with this name.</li>
        </ul>
    </div>
@endif

 <!-- Show All Products Button and Add Details -->
<div class="row mt-3">
    <div class="col">
        <div class="d-flex justify-content-between">
            <!-- Button Add Details -->
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add Details
            </button>
            <a href="{{ route('all-products') }}" class="btn btn-primary">Show All Products</a>
        </div>
    </div>
</div>
<!-- Validate request data for createProductDetails -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
     @endif 



    <!-- Modal in Add Details button -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-success" id="staticBackdropLabel">Add Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('create-product-details') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="product" class="text-dark">Select Product</label>
                                <select class="form-select" id="product" name="product">
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}" class="text-dark">{{$product->ProductName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="qty" class="text-dark">Quantity</label>
                                <input type="text" id="qty" class="form-control" name="qty">
                            </div>
                            <div class="col">
                                <label for="price" class="text-dark">Price</label>
                                <input type="text" id="price" class="form-control" name="price">
                            </div>
                            <div class="col">
                                <label for="color" class="text-dark">Color</label>
                                <input type="text" id="color" class="form-control" name="color">
                            </div>
                            <div class="col">
                                <label for="description" class="text-dark">Description</label>
                                <input type="text" id="description" class="form-control" name="description">
                            </div>
                        </div>
                        <!-- save and cancel -->
                        <button type="submit" class="btn btn-success mt-3">Save</button>
                        <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
    <div class="row text-dark">
        <div class="col">
            <div class="card">
                <div class="card-header bg-light">
                    Total Products: {{ count($products) }}
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Color</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                        @foreach ($products as $product)
    @php
        $productDetail = $productDetails->where('product_id', $product->id)->first();
    @endphp
    <tr>
        <th scope="row" class="text-dark">{{ $product->id }}</th>
        <td class="text-dark">{{ $product->ProductName }}</td>
        <td class="text-dark">{{ $productDetail ? $productDetail->qty : 'N/A' }}</td>
        <td class="text-dark">{{ $productDetail ? $productDetail->price : 'N/A' }}</td>
        <td class="text-dark">{{ $productDetail ? $productDetail->color : 'N/A' }}</td>
        <td class="text-dark">{{ $productDetail ? $productDetail->description : 'N/A' }}</td>
        <td class="d-flex">
            <!-- Edit Button -->
            <a href="{{ route('edit-product-details', ['id' => $product->id]) }}" class="btn btn-success mr-2"><i class="bi bi-pencil-square"></i> Edit</a>

            <!-- Delete Button -->
            <form action="{{ route('delete-product', ['id' => $product->id]) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i> Delete</button>
            </form>
        </td>
    </tr>
@endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
