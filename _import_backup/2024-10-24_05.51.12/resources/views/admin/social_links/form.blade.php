@extends("admin.admin_layout.default")
@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route("admin.home")}}">İletişim Bilgileri</a></li>
    @if(isset($data->id))
        <li class="breadcrumb-item active">{{trans('admin/form.breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active">{{trans('admin/form.breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('page-title')
İletişim Bilgileri
@endsection
@section('page-info')@endsection
@section('page-back-button')@endsection
@section('page-content')
<div class="form-container content-width-medium social-links-form-content js-ak-delete-container" data-delete-modal-action="{{route("admin.social_links.delete")}}">
    <form method="POST" action="@isset($data->id){{route("admin.social_links.update", $data->id)}}@else{{route("admin.social_links.store")}}@endisset" enctype="multipart/form-data" class="form-page validate-form" novalidate>
        <div hidden>
            @isset($data->id) @method('PUT') @endisset
            @csrf
        </div>
        <div class="form-header">
            <h3>{{ isset($data->id) ? trans('admin/form.update') : trans('admin/form.add_new') }}</h3>
        </div>
        @includeIf("admin.admin_layout.partials.form.errors")
        <div class="form-content">
            
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="telefon_numaras">Telefon numarası</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="telefon_numaras" autocomplete="off"
                                   name="telefon_numaras"  placeholder="Telefon numarası"
                                   value="{{{ old('telefon_numaras', $data->telefon_numaras??'') }}}">
                            <div class="error-message @if ($errors->has('telefon_numaras')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="telefon_numaras_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-email">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-data">
                            <input type="email" autocomplete="off" class="form-input" id="email" name="email" 
                                   placeholder="email"  value="{{{ old('email', $data->email??'') }}}">
                            <div class="error-message @if ($errors->has('email')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="email_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="working_hours">Çalışma Saatleri</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="working_hours" autocomplete="off"
                                   name="working_hours"  placeholder="&Ccedil;alışma Saatleri"
                                   value="{{{ old('working_hours', $data->working_hours??'') }}}">
                            <div class="error-message @if ($errors->has('working_hours')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="working_hours_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="instagram">İnstagram</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="instagram" autocomplete="off"
                                   name="instagram"  placeholder="İnstagram"
                                   value="{{{ old('instagram', $data->instagram??'') }}}">
                            <div class="error-message @if ($errors->has('instagram')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="instagram_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="facebook">facebook</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="facebook" autocomplete="off"
                                   name="facebook"  placeholder="facebook"
                                   value="{{{ old('facebook', $data->facebook??'') }}}">
                            <div class="error-message @if ($errors->has('facebook')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="facebook_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="twitter">twitter (X)</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="twitter" autocomplete="off"
                                   name="twitter"  placeholder="twitter (X)"
                                   value="{{{ old('twitter', $data->twitter??'') }}}">
                            <div class="error-message @if ($errors->has('twitter')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="twitter_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="katalog_indir_linki">Katalog indir linki</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="katalog_indir_linki" autocomplete="off"
                                   name="katalog_indir_linki"  placeholder="Katalog indir linki"
                                   value="{{{ old('katalog_indir_linki', $data->katalog_indir_linki??'') }}}">
                            <div class="error-message @if ($errors->has('katalog_indir_linki')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="katalog_indir_linki_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="adres">Adres</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="adres" autocomplete="off"
                                   name="adres"  placeholder="Adres"
                                   value="{{{ old('adres', $data->adres??'') }}}">
                            <div class="error-message @if ($errors->has('adres')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="adres_help"></div>
                        </div>
                    </div>
                </div>
        </div>
        @includeIf("admin.admin_layout.partials.form.footer",["cancel_route"=>route("admin.home")])
    </form>
</div>
@isset($data->id)
    @includeIf("admin.admin_layout.partials.delete_modal_confirm")
@endisset
@endsection