@extends('admin.admin_service.login.public_layout')
@section('content')
    <div class="auth-container">
        <h2>{{ trans('admin/admin_service/login.reset_title') }}</h2>
        <form method="POST" action="{{ route("admin.login.update",$reset_token) }}" class="form-page validate-form" novalidate>
            <div hidden>
                @csrf
            </div>
            @if ($errors->any())
                <div class="alert-danger-container">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{!!$error!!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="input-container">
                <div class="input-label">
                    <label for="password">{{ trans('admin/admin_service/login.password') }}</label>
                </div>
                <div class="input-data">
                    <input type="password" id="password" required name="password" class="form-input"  placeholder="{{ trans('admin/admin_service/login.password') }}" autofocus>
                    <div class="error-message">
                        {{ trans('admin/admin_service/login.required_password') }}
                    </div>
                </div>
            </div>
            <div class="input-container">
                <div class="input-label">
                    <label for="password_confirmation">{{ trans('admin/admin_service/login.password_confirmation') }}:</label>
                </div>
                <div class="input-data">
                    <input type="password" id="password_confirmation" required class="form-input"  name="password_confirmation" placeholder="{{ trans('admin/admin_service/login.password_confirmation') }}">
                    <div class="error-message">
                        {{ trans('admin/admin_service/login.required_password') }}
                    </div>
                </div>
            </div>
            <div class="auth-submit">
                <button type="submit" class="button primary-button js-ak-submit-button">
                    <span>
                        @includeIf("admin.admin_layout/partials/misc/loading")
                        {{ trans('admin/admin_service/login.password_confirmation_reset_button') }}
                    </span>
                </button>
            </div>
        </form>
    </div>
@endsection
