{{--This file is managed by Admiko and is not recommended to be modified since it may be overwritten during Admiko updates.--}}
@extends("admin.admin_layout.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('admin/admin_service/my_account.page_breadcrumb') }}</li>
@endsection
@section('page-title')
    {{ trans('admin/admin_service/my_account.page_title') }}
@endsection
@section('page-info')
    {{ trans('admin/admin_service/my_account.page_info') }}
@endsection
@section('page-back-button')@endsection
@section('page-content')
    <div class="form-container content-width-small">
        <form method="POST" action="{{route('admin.my_account.update')}}" enctype="multipart/form-data" class="form-page validate-form" novalidate>
            <div hidden>
                @method('PUT')
                @csrf
            </div>
            <div class="form-header">
                <h3>{{ trans('admin/admin_service/my_account.label_form') }}</h3>
            </div>
            <div class="form-content">
                <div class="row-100">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="name">{{ trans('admin/admin_service/my_account.name') }}<span class="required">*</span></label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="name" name="name" required autocomplete="off"
                                   placeholder="{{ trans('admin/admin_service/my_account.name_placeholder') }}"
                                   value="{{ old('name', auth()->user()->name) }}">
                            <div class="error-message @if ($errors->has('name')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div id="name_help" class="text-muted">{{ trans('admin/admin_service/my_account.name_info') }}</div>
                        </div>
                    </div>
                </div>
                <div class="row-100">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="email">{{ trans('admin/admin_service/my_account.email') }}<span class="required">*</span></label>
                        </div>
                        <div class="input-data">
                            <input type="email" autocomplete="off" class="form-input" id="email" name="email" required
                                   placeholder="{{ trans('admin/admin_service/my_account.email_placeholder') }}" value="{{{ old('email', auth()->user()->email) }}}">
                            <div class="error-message @if ($errors->has('email')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="email_help">{{ trans('admin/admin_service/my_account.email_info') }}</div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-image-cropper">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="image">{{ trans('admin/admin_service/my_account.image') }}<span class="required">*</span></label>
                        </div>
                        <div class="input-data">
                            @if (auth()->user()->image)
                                <a href="{{ auth()->user()->image }}" class="form-image-preview js-base64-image-preview js-ak-image-available">
                                    <img src="{{ auth()->user()->image }}">
                                </a>
                            @endif
                            <div class="cropper-content js-ak-cropper-container" style="display: none;max-width: 500px">
                                <div><img class="cropper-image js-ak-cropper-image"></div>
                                <div class="cropper-tools">
                                    @includeIf("admin.admin_layout.partials.form.cropper_tools")
                                </div>
                            </div>
                            <input type="hidden" class="js-ak-cropped-save" name="image" value="">
                            <input type="file" class="form-file js-ak-image-cropper-upload" data-id="image" accept=".jpg,.png,.jpeg,.webp" data-file-type=".jpg,.png,.jpeg,.webp" data-max-width="200"
                                   @if(!auth()->user()->image) required @endIf>
                            <input type="hidden" name="ak_image_current" value="{{auth()->user()->image}}">
                            <div class="error-message @if ($errors->has('image')) show @endif" data-required="{{trans('admin/form.required_image')}}" data-size="{{trans('admin/form.required_size')}}" data-type="{{trans('admin/form.required_type')}}" data-size-type="{{trans('admin/form.invalid_size_or_type')}}">
                                @if ($errors->has('image'))
                                    {{ $errors->first('image') }}
                                @endif
                            </div>
                            <div class="text-muted" id="image_help">{{ trans('admin/admin_service/my_account.image_info') }}</div>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->show_theme == 1)
                    <div class="row-100 el-box-select-custom">
                        <div class="input-container">
                            <div class="input-label">
                                <label for="theme">{{trans('admin/admin_service/my_account.theme_title')}}</label>
                            </div>
                            <div class="input-data">
                                <select class="form-select" id="theme" name="theme">
                                    @foreach(auth()->user()->getAdminThemes() as $value => $label)
                                        <option value="{{ $value }}" {{ (old('theme') ? old('theme') : auth()->user()->theme ?? '') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <div class="error-message @if ($errors->has('theme')) show @endif">{{trans('admin/form.required_text')}}</div>
                                <div class="text-muted" id="theme_help">{{trans('admin/admin_service/my_account.theme_description')}}</div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(auth()->user()->show_language == 1)
                    <div class="row-100 el-box-select-custom">
                        <div class="input-container">
                            <div class="input-label">
                                <label for="language">{{trans('admin/admin_service/my_account.language_title')}}</label>
                            </div>
                            <div class="input-data">
                                <select class="form-select" id="language" name="language">
                                    @foreach(auth()->user()->getAdminLanguages() as $value => $label)
                                        <option value="{{ $value }}" {{ (old('language') ? old('language') : auth()->user()->language ?? '') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <div class="error-message @if ($errors->has('language')) show @endif">{{trans('admin/form.required_text')}}</div>
                                <div class="text-muted" id="language_help">{{trans('admin/admin_service/my_account.language_description')}}</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @includeIf("admin.admin_layout.partials.form.footer",["cancel_route"=>""])
        </form>
    </div>
    <div class="form-container content-width-small">
        <form method="POST" action="{{route('admin.my_account.update_password')}}" enctype="multipart/form-data" class="form-page validate-form" novalidate>
            <div hidden>
                @method('PUT')
                @csrf
            </div>
            <div class="form-header">
                <h3>{{ trans('admin/admin_service/my_account.label_form_password') }}</h3>
            </div>
            @includeIf("admin.admin_layout.partials.form.errors")
            <div class="form-content">
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="password">{{ trans('admin/admin_service/my_account.password') }}<span class="required">*</span></label>
                        </div>
                        <div class="input-data">
                            <input type="password" class="form-input" autocomplete="new-password" id="password" name="password" required placeholder="{{ trans('admin/admin_service/my_account.password_placeholder') }}" value="{{ old('password'??'') }}">
                            <div class="error-message">
                                {{ trans('admin/admin_service/my_account.required_field') }}
                            </div>
                            <div class="text-muted" id="language_help">{{trans('admin/admin_service/my_account.password_description')}}</div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="password_confirmation">{{ trans('admin/admin_service/my_account.password_confirmation') }}<span class="required">*</span></label>
                        </div>
                        <div class="input-data">
                            <input type="password" class="form-input" autocomplete="new-password" id="password_confirmation" required name="password_confirmation" placeholder="{{ trans('admin/admin_service/my_account.password_confirmation_placeholder') }}" value="{{ old('password_confirmation'??'') }}">
                            <div class="error-message">
                                {{ trans('admin/admin_service/my_account.required_field') }}
                            </div>
                            <div class="text-muted" id="language_help">{{trans('admin/admin_service/my_account.password_confirmation_description')}}</div>
                        </div>
                    </div>
                </div>
            </div>
            @includeIf("admin.admin_layout.partials.form.footer",["cancel_route"=>""])
        </form>
    </div>
@endsection
