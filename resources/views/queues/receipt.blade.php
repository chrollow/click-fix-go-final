@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">We Repair and Clean It All!</h1>
    <p class="text-center mb-5">Choose your option to manage:</p>
    <div class="row">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="purple card help-button rounded-4 p-2">
                <div class="card-body">
                    <h3 class="card-title">Queue ID: {{ $queue->id }}</h3>
                    <p class="card-text">Customer Name: {{ $queue->customer_name }}</p>
                    <p class="card-text">Scheduled Date: {{ $queue->scheduled_date }}</p>
                    <p class="card-text">Phone Number: {{ $queue->phone_number }}</p>
                    <p class="card-text">Status: {{ $queue->status }}</p>
                    <p class="card-text">Order Total: {{ $queue->order_total }}</p>
                    <form method="post" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


