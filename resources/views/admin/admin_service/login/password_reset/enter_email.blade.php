@extends('admin.admin_service.login.public_layout')
@section('content')
    <div class="auth-container">
        <h2>{{ trans('admin/admin_service/login.reset_header') }}</h2>
        <form method="POST" action="{{ route("admin.login.send") }}" class="form-page validate-form" novalidate>
            <div hidden>
                @csrf
            </div>
            @if(session()->has('error'))
                <div class="danger-text">{{ session()->get('error') }}</div>
            @endif
            @if(session()->has('message_sent'))
                <div>{{ session()->get('message_sent') }}</div>
            @else
                <div class="input-container">
                    <div class="input-label">
                        <label for="email">{{ trans('admin/admin_service/login.email') }}:</label>
                    </div>
                    <div class="input-data">
                        <input type="email" required id="email" name="email" class="form-input" placeholder="{{ trans('admin/admin_service/login.email_placeholder') }}" value="{{ old('email') }}" autofocus>
                        <div class="error-message">{{ trans('admin/admin_service/login.required_email') }}</div>
                    </div>
                </div>
                <div class="auth-submit">
                    <div class="auth-submit">
                        <button type="submit" class="button primary-button js-ak-submit-button">
                            <span>
                                {{ trans('admin/admin_service/login.reset_password_button') }}
                            </span>
                        </button>
                    </div>
                </div>
                <div>
                    <a href="{{ route("admin.login") }}">{{ trans('admin/admin_service/login.back_to_login') }}</a>
                </div>
            @endif
        </form>
@endsection
