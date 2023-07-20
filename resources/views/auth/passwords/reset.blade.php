
@extends('layouts.guest-app')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ __('Reset Password') }}</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <x-inputs.email :placeholder="ucfirst(trans('validation.attributes.email'))" required="required" autofocus />

            <x-inputs.password :placeholder="ucfirst(trans('validation.attributes.password'))" />

            <x-inputs.password :placeholder="ucfirst(trans('validation.attributes.password_confirmation'))" key="password_confirmation" />

            <div class="row">
                <div class="offset-6 col-6">
                    <x-inputs.button :text="__('Reset Password')" class="btn-primary" />
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
