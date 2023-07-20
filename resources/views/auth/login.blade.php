@extends('layouts.guest-app')

@section('title')
    {{ trans('Login') }}
@endsection

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <form method="POST" action="login">
            @csrf

            <x-inputs.email required="required" placeholder="Email" autofocus />

            <x-inputs.password placeholder="{{ ucfirst(trans('validation.attributes.password')) }}" />

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">{{ ucfirst(trans('validation.attributes.remember_me')) }}</label>
                    </div>
                </div>

                <div class="col-4">
                    <x-inputs.button :text="trans('Login')" class="btn-primary" />
                </div>
            </div>
        </form>

        <p class="mb-1">
            <a href="{{ route('password.request') }}">
                {{ trans('Forgot Your Password?') }}
            </a>
        </p>
    </div>
</div>

@endsection
