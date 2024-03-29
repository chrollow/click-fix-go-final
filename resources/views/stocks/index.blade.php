@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Stocks</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-auto">
            <a href="{{ route('stocks.create') }}" class="btn btn-success">Add Stock</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped" style="background-color: white;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $stock)
                    <tr>
                        <td>{{ $stock->stock_id }}</td>
                        <td>{{ $stock->stock_name }}</td>
                        <td>{{ $stock->qty }}</td>
                        <td>{{ $stock->price }}</td>
                        <td>
                            <div class="d-flex">
                                {{-- <a href="{{ route('stocks.edit', ['stock' => $stock->id]) }}" class="btn btn-primary">Edit</a> --}}

                                {{-- <form method="post" action="{{ route('stocks.destroy', ['stock' => $stock->id]) }}"> --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
