@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Stock</h5>
        </div>
        <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="post" action="{{ route('stocks.update', $stock->stock_id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="stock_name">Stock Name</label>
                    <input type="text" id="stock_name" name="stock_name" value="{{ $stock->stock_name }}" class="form-control" placeholder="Stock Name">
                </div>
                <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="number" id="qty" name="qty" value="{{ $stock->qty }}" class="form-control" placeholder="Quantity">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" value="{{ $stock->price }}" class="form-control" placeholder="Price">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
