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
        <a href="{{ route('technicians.create') }}" class="btn btn-success">Create Technician</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Actions</th> <!-- Added a column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($technicians as $technician)
                <tr>
                    <td>{{ $technician->technician_name }}</td>
                    <td>{{ $technician->phone_number }}</td>
                    <td>{{ $technician->email }}</td>
                    <td>
                        <a href="{{ route('technicians.edit', $technician->technician_id) }}" class="btn btn-primary">Edit</a>
                        <form method="post" action="{{ route('technicians.destroy', $technician->technician_id) }}">
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
@endsection
