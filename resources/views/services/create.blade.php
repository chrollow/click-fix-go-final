@extends('layouts.app')

@section('content')
<div class="container">
    {!! Form::open(['route' => 'services.store', 'class' => 'form-control', 'method' => 'post']) !!}
    {{ Form::label('service_type', 'Service Type') }}
    {!! Form::text('service_type', null, ['class' => 'form-control']) !!}
    {!! Form::hidden('device_id', $device_id, ['class' => 'form-control']) !!}
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
@endsection
