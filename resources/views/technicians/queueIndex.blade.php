@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Suppliers</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('suppliers.create') }}" class="btn btn-success">Create Supplier</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Scheduled Date</th>
                <th>Phone Number</th>
                <th>Status</th>
                <th>Actions</th> <!-- Added a column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($queues as $queue)
                <tr>
                    <td>{{ $queue->queue_id }}</td>
                    <td>{{ $queue->customer_name }}</td>
                    <td>{{ $queue->scheduled_date }}</td>
                    <td>{{ $queue->phone_number }}</td>
                    <td>{{ $queue->status }}</td>
                    <td>
                        <a href="{{ route('techniciansqueue.edit', $queue->queue_id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('techniciansqueue.finish', $queue->queue_id) }}" class="btn btn-primary">Finish Queue</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
