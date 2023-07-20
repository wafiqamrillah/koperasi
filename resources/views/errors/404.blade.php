@section('title')
    {{ __('Not Found') }}
@endsection

@extends('errors.app')

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> {{ __('Oops! Page not found.') }}</h3>
        <p>
            {{ __('We could not find the page you were looking for.') }}
            {{ __('Would you like to go to') }} <a href="{{ route('home.index') }}">{{ __('return to dashboard') }}</a>?
        </p>
    </div>
</div>

@endsection
