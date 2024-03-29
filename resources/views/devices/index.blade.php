@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">We Repair and Clean It All!</h1>
    <p class="text-center mb-5">Choose your option to manage:</p>
    <div class="row">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="purple card help-button rounded-4 p-2">
                <div class="card-body">
                    <h3 class="card-title">Add New Device</h3>
                    <p class="card-text">Expand your scope by adding a new device</p>
                    <a href="{{ route('devices.create') }}" class="btn btn-primary">Add New Device</a>
                </div>
            </div>
        </div>
        @foreach ($types as $type)
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="purple card help-button rounded-4 p-2 h-100">
                <div>
                    <img src="{{ asset($type->image) }}" alt="{{ $type->device_type }}" class="card-img-top" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
                <div class="card-body">
                    <h3 class="card-title">{{ $type->device_type }}</h3>
                    <p class="card-text">Expert repairs for all major brands and models.</p>
                    <div class="text-center">
                        <a href="/devices/{{ $type->device_id }}/edit" class="btn btn-primary">Edit {{ $type->device_type }}</a>
                        <form method="post" action="/devices/{{$type->device_id}}/destroy" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

