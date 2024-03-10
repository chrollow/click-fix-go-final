@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-center my-4">We Repair and Clean It All!</h1>
    <p class="text-center mb-5">Choose your device type to explore our services:</p>
    <div class="device-gallery">
        <div class="row">
            <div class="col-md-4 col-sm-6 device-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Add new service to offer</h3>
                        <p class="card-text">Expand your scope</p>
                        <a href="{{route('service.create')}}" class="btn btn-primary">Click here to add a new device</a>
                    </div>
                </div>
            </div>
            @foreach ($services as $service)
                <div class="col-md-4 col-sm-6 device-card">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $service->service_type }}</h3>
                            <p class="card-text">Expert repairs for all major brands and models.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection