{{--This file is managed by Admiko and is not recommended to be modified since it may be overwritten during Admiko updates.--}}
@extends('admin.admin_service.login.public_layout')
@section('content')
    <div class="auth-container">
        <h2>{{ trans('admin/admin_service/login.login_header') }}</h2>
        <form method="POST" action="{{ route("admin.login") }}" class="form-page validate-form" novalidate>
            <div hidden>
                @csrf
            </div>
            @if(session()->has('error'))
                <div class="danger-text">{{ session()->get('error') }}</div>
            @endif
            <div class="input-container">
                <div class="input-label">
                    <label for="email">{{ trans('admin/admin_service/login.email') }}</label>
                </div>
                <div class="input-data">
                    <input type="email" required id="email" name="email" class="form-input" placeholder="{{ trans('admin/admin_service/login.email_placeholder') }}" value="{{ old('email') }}" autofocus>
                    <div class="error-message">{{ trans('admin/admin_service/login.required_email') }}</div>
                </div>
            </div>
            <div class="input-container">
                <div class="input-label">
                    <label for="password">{{ trans('admin/admin_service/login.password') }}</label>
                </div>
                <div class="input-data">
                    <input type="password" required id="password" name="password" class="form-input" placeholder="{{ trans('admin/admin_service/login.password_placeholder') }}">
                    <div class="error-message">
                        {{ trans('admin/admin_service/login.required_password') }}
                    </div>
                </div>
            </div>
            <div class="auth-remember">
                <div class="checkbox-container">
                    <label class="checkbox-input" for="remember">
                        <input type="checkbox" class="form-checkbox" value="1" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        {{ trans('admin/admin_service/login.remember_me') }}
                    </label>
                </div>
                <div>
                    @if(config('admin.settings.allow_login_password_reset'))
                        <a href="{{ route("admin.login.email") }}">{{ trans('admin/admin_service/login.forgot_password') }}</a>
                    @endif
                </div>
            </div>
            <div class="auth-submit">
                <button type="submit" class="button primary-button js-ak-submit-button">
                    <span>
                        @includeIf("admin.admin_layout/partials/misc/loading")
                        {{ trans('admin/admin_service/login.login_button') }}
                    </span>
                </button>
            </div>
        </form>
    </div>
@endsection
