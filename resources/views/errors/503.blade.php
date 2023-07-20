@section('title')
    {{ __('Service Unavailable') }}
@endsection

@extends('errors.app')

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> {{ __('Service Unavailable') }}</h3>
        <p>
            {{ $exception->getMessage() ?: __('Service is not available. Please try again later.') }}
        </p>
    </div>
</div>
