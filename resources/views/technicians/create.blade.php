@extends('layouts.app')

@section('content')
<div class="container">
    {!! Form::open(['route' => 'suppliers.store', 'class' => 'form-control', 'method' => 'post']) !!}
    {!! Form::hidden('user_id', $userId) !!}
    {{ Form::label('technician_name', 'Technician Name') }}
    {!! Form::text('technician_name', $name, ['readonly' => 'readonly']) !!}
    {{ Form::label('phone_number', 'Phone Number') }}
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
    {{ Form::label('email', 'Email Address') }}
    {!! Form::email('email', $email, ['readonly' => 'readonly']) !!}
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>
@endsection
