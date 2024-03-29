@extends('layouts.base')

@section('body')
<div class="container">
    <div class="card col-12 col-md-8 col-lg-6 m-auto border-0 shadow-lg">
        <div class="card-header bg-dark-blue text-light">
            {{ __('Update Device') }}
        </div>
        <div class="card-body">
            {!! Form::model($service, ['route' => ['services.update', $service->service_id], 'class' => 'form-control', 'method' => 'put']) !!}
            {{-- Device Type --}}
            <div class="mb-3">
                {{ Form::label('service_type', __('Service Type'), ['class' => 'form-label']) }}
                {!! Form::text('service_type', $service->service_type, ['class' => 'form-control']) !!}
            </div>
            {{-- Submit Button --}}
            <div class="mb-3">
                {!! Form::submit(__('Submit'), ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
