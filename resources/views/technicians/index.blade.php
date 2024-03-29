@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Technicians</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('technicians.register') }}" class="btn btn-success">Create Technician</a>
    </div>

    <table class="table table-dark">
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Specialty</th>
                <th>Actions</th> <!-- Added a column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($technicians as $technician)
                <tr>
                    <td>{{ $technician->technician_name }}</td>
                    <td>{{ $technician->phone_number }}</td>
                    <td>{{ $technician->email }}</td>
                    <td>{{ $technician->specialty_type }}</td>
                    <td>
                        <a href="{{ route('technicians.edit', $technician->technician_id) }}" class="btn btn-primary">Edit</a>
                        <form method="post" action="{{ route('technicians.destroy') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="technician_id" value="{{ $technician->technician_id }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
