@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add Stock</h5>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'stocks.store', 'method' => 'post']) !!}
            <div class="form-group">
                {{ Form::label('stock_name', 'Stock Name') }}
                {!! Form::text('stock_name', null, ['class' => 'form-control', 'placeholder' => 'Stock Name']) !!}
            </div>
            <div class="form-group">
                {{ Form::label('qty', 'Quantity') }}
                {!! Form::number('qty', null, ['class' => 'form-control', 'placeholder' => 'Quantity']) !!}
            </div>
            <div class="form-group">
                {{ Form::label('price', 'Price') }}
                {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price']) !!}
            </div>
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
