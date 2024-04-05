@extends('layouts.base')

@section('content')
    <div class="container">
        <!-- Search Bar -->

        <!-- form that sends a GET request to the 'get-products' route when submitted -->
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


        <!-- Add New Product and Show All Products Buttons -->
        <div class="row mt-3">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Product</button>
                    <a href="{{ route('all-products') }}" class="btn btn-primary">Show All Products</a>
                </div>

                <!-- Add New Product Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-success" id="staticBackdropLabel">Add New Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('createproducts') }}" method="POST">
                    @csrf
                    <!-- Display validation errors for product  -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Product Name Input -->
                    <input type="text" class="form-control" name="ProductName" placeholder="Product Name">
                    <!-- Save and Cancel Buttons -->
                    <button type="submit" class="btn btn-info mt-3">Save</button>
                    <button type="button" class="btn btn-secondary mt-3" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


        <!-- Product Table -->
        <div class="row mt-5 text-dark">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row" class="text-dark">{{ $product->id }}</th>
                                        <td class="text-dark">{{ $product->ProductName }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('delete-product', ['id' => $product->id]) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i> Delete</button>
                                            </form>
                                            <!-- Add Details Button -->
                                            <a href="{{ route('product-details', ['id' => $product->id]) }}" class="btn btn-info"><i class="bi bi-file-plus"></i> Add Details</a>
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
