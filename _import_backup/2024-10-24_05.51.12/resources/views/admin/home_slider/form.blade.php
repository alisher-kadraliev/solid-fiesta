@extends("admin.admin_layout.default")
@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{ route("admin.home_slider.index") }}">Anasayfa Slider</a></li>
    @if(isset($data->id))
        <li class="breadcrumb-item active">{{trans('admin/form.breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active">{{trans('admin/form.breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('page-title')
Anasayfa Slider
@endsection
@section('page-info')@endsection
@section('page-back-button'){{ route("admin.home_slider.index") }}@endsection
@section('page-content')
<div class="form-container content-width-medium home-slider-form-content js-ak-delete-container" data-delete-modal-action="{{route("admin.home_slider.delete")}}">
    <form method="POST" action="@isset($data->id){{route("admin.home_slider.update", $data->id)}}@else{{route("admin.home_slider.store")}}@endisset" enctype="multipart/form-data" class="form-page validate-form" novalidate>
        <div hidden>
            @isset($data->id) @method('PUT') @endisset
            @csrf
        </div>
        <div class="form-header">
            <h3>{{ isset($data->id) ? trans('admin/form.update') : trans('admin/form.add_new') }}</h3>
            <div class="form-delete-record">
                @can('home_slider_delete')
                    @if(isset($data->id))
                    <a href="#" data-id="{{$data->id}}" class="delete-link js-ak-delete-link" draggable="false">
                        @includeIf("admin/admin_layout/partials/misc/icons/delete_icon")
                    </a>
                    @endIf
                @endcan
            </div>
        </div>
        @includeIf("admin.admin_layout.partials.form.errors")
        <div class="form-content">
            
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="title">Başlık</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="title" autocomplete="off"
                                   name="title"  placeholder="Başlık"
                                   value="{{{ old('title', $data->title??'') }}}">
                            <div class="error-message @if ($errors->has('title')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="title_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="alt_title">Alt Başlık</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="alt_title" autocomplete="off"
                                   name="alt_title"  placeholder="Alt Başlık"
                                   value="{{{ old('alt_title', $data->alt_title??'') }}}">
                            <div class="error-message @if ($errors->has('alt_title')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="alt_title_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-image">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="foto">Foto</label>
                        </div>
                        <div class="input-data">
                            @if ($data->foto)
                                <div>
                                    <a href="{{ $data->foto }}" target="_blank" class="form-image-preview js-ak-foto-available">
                                        <img src="{{ $data->foto }}">
                                    </a>
                                </div>
                                <div>
                                    <label for="ak_foto_delete" class="checkbox-input">
                                        <input class="form-checkbox" type="checkbox" name="ak_foto_delete" id="ak_foto_delete" value="1">
                                        {{trans('admin/form.remove_file')}}
                                    </label>
                                </div>
                            @elseif(isset($data->foto) && $data->getRawOriginal("foto"))
                                <div class="alert-info-container">
                                    <div>'{{$data->getRawOriginal("foto")}}' {{trans('admin/form.file_location_error')}}</div>
                                </div>
                            @endif
                            <input type="file" class="form-file js-ak-image-upload" data-id="foto" accept=".jpg,.jpeg,.png,.webp" data-file-type=".jpg,.jpeg,.png,.webp"  name="foto"  data-selected="{{trans('admin/form.image_preview')}}" >
                            <input type="hidden" name="ak_foto_current" value="{{$data->getRawOriginal("foto")??''}}">
                            <div class="error-message @if ($errors->has('foto')) show @endif" data-required="{{trans('admin/form.required_image')}}" data-size="{{trans('admin/form.required_size')}}" data-type="{{trans('admin/form.required_type')}}" data-size-type="{{trans('admin/form.invalid_size_or_type')}}">
                                @if ($errors->has('foto')){{ $errors->first('foto') }}@endif
                            </div>
                            <div class="text-muted" id="foto_help">{{trans("admin/form.file_extension_limit")}}.jpg,.jpeg,.png,.webp. {{trans("admin/form.image_recommended")}}{{trans("admin/form.image_width")}}1920px, {{trans("admin/form.image_height")}}1080px. {{trans("admin/form.image_image_action")}}{{trans("admin/form.image_image_action_resize")}}.</div>
                        </div>
                    </div>
                </div>
        </div>
        @includeIf("admin.admin_layout.partials.form.footer",["cancel_route"=>route("admin.home_slider.index")])
    </form>
</div>
@isset($data->id)
    @includeIf("admin.admin_layout.partials.delete_modal_confirm")
@endisset
@endsection