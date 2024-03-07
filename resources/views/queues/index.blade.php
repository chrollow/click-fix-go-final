@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-center my-4">We Repair and Clean It All!</h1>
    <p class="text-center mb-5">Choose your device type to explore our services:</p>
    <div class="device-gallery">
        <div class="row">
            @foreach ($queues as $queue)
                <div class="col-md-4 col-sm-6 device-card">
                    <div class="red card help-button rounded-4 p-2">
                        <div class="card-body">
                            <h3 class="card-title">Queue: {{ $queue }}</h3>
                            <p class="card-text">Manage tickets for queue {{ $queue }}</p>
                            <a href="/queues/{{$queue}}/tickets" class="btn btn-primary">Click here</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection