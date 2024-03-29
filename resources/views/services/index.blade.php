@extends('layouts.app')

@section('content')

@if (Auth::check() && Auth::user()->role == 'admin')
<div class="container">
    <h1>Services</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('services.create', $services->first()->device_id) }}" class="btn btn-success">Create Service</a>
    </div>

    <table class="table table table-dark">
        <thead>
            <tr>
                <th>Id</th>
                <th>Service type</th>
                <th>Actions</th> <!-- Added a column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->service_id }}</td>
                    <td>{{ $service->service_type }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service->service_id) }}" class="btn btn-primary">Edit</a>
                        <form method="post" action="{{ route('services.destroy', $service->service_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="container">
    <h1 class="text-center my-4">We Repair and Clean It All!</h1>
    <p class="text-center mb-5">Choose your service type to explore our services:</p>
    
    <div class="mb-3">
        <a href="/queue/create/{{ $services->first()->device_id }}" class="btn btn-success">Book Appointment</a>
    </div>

    <div class="row">
        @foreach ($services as $service)
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="green card help-button rounded-4 p-2">
                <div class="card-body">
                    <h1 class="card-title">{{ $service->service_type }}</h1>
                    <p class="card-text">Expert repairs for all major brands and models.</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection