@extends('layouts.base')

@section('content')

<!-- Button trigger modal -->
<div class="container">
<span class="text-dark">{{ Session::get('data') }}</span>
<span class="text-dark">{{ Cookie::get('A') }}</span>

 <!-- Display validation errors  -->
 @if (Session::has('errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach (Session::get('errors')->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center"><i class="bi bi-receipt-cutoff text-success"></i></h1>
                    <h4 class="text-dark text-center">Invoices</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center"><i class="bi bi-receipt-cutoff text-success"></i></h1>
                    <h4 class="text-dark text-center">Products</h4>
                </div>
            </div>
        </div>
        <div class="col">
            
        </div>
        <div class="col">
            
        </div>

    </div>
</div>

@endsection