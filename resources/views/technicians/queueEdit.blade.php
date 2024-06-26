@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tickets</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-dark">
        <thead>
            <tr>
                <th>Id</th>
                <th>Device Type</th>
                <th>Service Type</th>
                <th>Technician Name</th>
                <th>Status</th>
                <th>Stocks Used</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ticket_id }}</td>
                    <td>{{ $ticket->device_type }}</td>
                    <td>{{ $ticket->service_type }}</td>
                    <td>{{ $ticket->technician_name }}</td>
                    <td>{{ $ticket->status }}</td>    
                    <td>
                        {{-- <a href="{{ route('tickets.finish', $ticket->ticket_id) }}" class="btn btn-primary">Finish</a> --}}
                        <form method="post" action="{{ route('tickets.finish') }}">
                            @csrf
                            <select name = "stock_id">
                                @foreach ($stocks as $stock)
                                    <option value="{{ $stock->stock_id }}">{{ $stock->stock_name }}</option>
                                @endforeach
                            </select>
                            {!! Form::hidden('ticket_id', $ticket->ticket_id) !!}
                            {!! Form::hidden('technician_name', $user->name) !!}
                            {!! Form::hidden('user_id', $user->id) !!}
                            <button type="submit" class="btn btn-danger">Finish</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection

