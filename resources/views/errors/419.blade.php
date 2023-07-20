@section('title')
    {{ __('Page Expired') }}
@endsection

@extends('errors.app')

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> {{ __('Page Expired') }}</h3>
        <p>
            {{ $exception->getMessage() ?: __('Please refresh the page.') }}
        </p>
    </div>
</div>
