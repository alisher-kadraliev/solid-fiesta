@extends("admin.admin_layout.default")
@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{ route("admin.fixed_content.index") }}">Sabit içerik yönetimi</a></li>
    @if(isset($data->id))
        <li class="breadcrumb-item active">{{trans('admin/form.breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active">{{trans('admin/form.breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('page-title')
Sabit içerik yönetimi
@endsection
@section('page-info')@endsection
@section('page-back-button'){{ route("admin.fixed_content.index") }}@endsection
@section('page-content')
<div class="form-container content-width-medium fixed-content-form-content js-ak-delete-container" data-delete-modal-action="{{route("admin.fixed_content.delete")}}">
    <form method="POST" action="@isset($data->id){{route("admin.fixed_content.update", $data->id)}}@else{{route("admin.fixed_content.store")}}@endisset" enctype="multipart/form-data" class="form-page validate-form" novalidate>
        <div hidden>
            @isset($data->id) @method('PUT') @endisset
            @csrf
        </div>
        <div class="form-header">
            <h3>{{ isset($data->id) ? trans('admin/form.update') : trans('admin/form.add_new') }}</h3>
            <div class="form-delete-record">
                @can('fixed_content_delete')
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
                            <label for="title">Başlık<span class="required">*</span></label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="title" autocomplete="off"
                                   name="title" required placeholder="Başlık"
                                   value="{{{ old('title', $data->title??'') }}}">
                            <div class="error-message @if ($errors->has('title')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="title_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-textarea">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="description">Açıklama</label>
                        </div>
                        <div class="input-data">
                            <textarea class="form-input form-textarea " id="description" data-height="250" style="height:250px" name="description"  placeholder="A&ccedil;ıklama">{{{ old('description', $data->description??'') }}}</textarea>
                            <div class="error-message @if ($errors->has('description')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="description_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-image">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="image">foto</label>
                        </div>
                        <div class="input-data">
                            @if ($data->image)
                                <div>
                                    <a href="{{ $data->image }}" target="_blank" class="form-image-preview js-ak-image-available">
                                        <img src="{{ $data->image }}">
                                    </a>
                                </div>
                                <div>
                                    <label for="ak_image_delete" class="checkbox-input">
                                        <input class="form-checkbox" type="checkbox" name="ak_image_delete" id="ak_image_delete" value="1">
                                        {{trans('admin/form.remove_file')}}
                                    </label>
                                </div>
                            @elseif(isset($data->image) && $data->getRawOriginal("image"))
                                <div class="alert-info-container">
                                    <div>'{{$data->getRawOriginal("image")}}' {{trans('admin/form.file_location_error')}}</div>
                                </div>
                            @endif
                            <input type="file" class="form-file js-ak-image-upload" data-id="image" accept=".jpg,.jpeg,.png,.webp" data-file-type=".jpg,.jpeg,.png,.webp"  name="image"  data-selected="{{trans('admin/form.image_preview')}}" >
                            <input type="hidden" name="ak_image_current" value="{{$data->getRawOriginal("image")??''}}">
                            <div class="error-message @if ($errors->has('image')) show @endif" data-required="{{trans('admin/form.required_image')}}" data-size="{{trans('admin/form.required_size')}}" data-type="{{trans('admin/form.required_type')}}" data-size-type="{{trans('admin/form.invalid_size_or_type')}}">
                                @if ($errors->has('image')){{ $errors->first('image') }}@endif
                            </div>
                            <div class="text-muted" id="image_help">{{trans("admin/form.file_extension_limit")}}.jpg,.jpeg,.png,.webp. {{trans("admin/form.image_recommended")}}{{trans("admin/form.image_width")}}1920px, {{trans("admin/form.image_height")}}1080px. {{trans("admin/form.image_image_action")}}{{trans("admin/form.image_image_action_resize")}}.</div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="product_catalog_title">Ürünler Katalog başlık</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="product_catalog_title" autocomplete="off"
                                   name="product_catalog_title"  placeholder="&Uuml;r&uuml;nler Katalog başlık"
                                   value="{{{ old('product_catalog_title', $data->product_catalog_title??'') }}}">
                            <div class="error-message @if ($errors->has('product_catalog_title')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="product_catalog_title_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-textarea">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="product_catalog_desc">Ürünler Katalog açıklama</label>
                        </div>
                        <div class="input-data">
                            <textarea class="form-input form-textarea " id="product_catalog_desc" data-height="250" style="height:250px" name="product_catalog_desc"  placeholder="&Uuml;r&uuml;nler Katalog a&ccedil;ıklama">{{{ old('product_catalog_desc', $data->product_catalog_desc??'') }}}</textarea>
                            <div class="error-message @if ($errors->has('product_catalog_desc')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="product_catalog_desc_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="about1">Hakkımızda başlık bir</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="about1" autocomplete="off"
                                   name="about1"  placeholder="Hakkımızda başlık bir"
                                   value="{{{ old('about1', $data->about1??'') }}}">
                            <div class="error-message @if ($errors->has('about1')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="about1_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-textarea">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="about_top_desc">Hakkımızda üst açıklama</label>
                        </div>
                        <div class="input-data">
                            <textarea class="form-input form-textarea " id="about_top_desc" data-height="250" style="height:250px" name="about_top_desc"  placeholder="Hakkımızda &uuml;st başlık">{{{ old('about_top_desc', $data->about_top_desc??'') }}}</textarea>
                            <div class="error-message @if ($errors->has('about_top_desc')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="about_top_desc_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-textarea">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="about_down_desc">Hakkımızda alt açıklama</label>
                        </div>
                        <div class="input-data">
                            <textarea class="form-input form-textarea " id="about_down_desc" data-height="250" style="height:250px" name="about_down_desc"  placeholder="Hakkımızda alt a&ccedil;ıklama">{{{ old('about_down_desc', $data->about_down_desc??'') }}}</textarea>
                            <div class="error-message @if ($errors->has('about_down_desc')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="about_down_desc_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-image">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="about_foto">Hakkımızda foto</label>
                        </div>
                        <div class="input-data">
                            @if ($data->about_foto)
                                <div>
                                    <a href="{{ $data->about_foto }}" target="_blank" class="form-image-preview js-ak-about_foto-available">
                                        <img src="{{ $data->about_foto }}">
                                    </a>
                                </div>
                                <div>
                                    <label for="ak_about_foto_delete" class="checkbox-input">
                                        <input class="form-checkbox" type="checkbox" name="ak_about_foto_delete" id="ak_about_foto_delete" value="1">
                                        {{trans('admin/form.remove_file')}}
                                    </label>
                                </div>
                            @elseif(isset($data->about_foto) && $data->getRawOriginal("about_foto"))
                                <div class="alert-info-container">
                                    <div>'{{$data->getRawOriginal("about_foto")}}' {{trans('admin/form.file_location_error')}}</div>
                                </div>
                            @endif
                            <input type="file" class="form-file js-ak-image-upload" data-id="about_foto" accept=".jpg,.jpeg,.png,.webp" data-file-type=".jpg,.jpeg,.png,.webp"  name="about_foto"  data-selected="{{trans('admin/form.image_preview')}}" >
                            <input type="hidden" name="ak_about_foto_current" value="{{$data->getRawOriginal("about_foto")??''}}">
                            <div class="error-message @if ($errors->has('about_foto')) show @endif" data-required="{{trans('admin/form.required_image')}}" data-size="{{trans('admin/form.required_size')}}" data-type="{{trans('admin/form.required_type')}}" data-size-type="{{trans('admin/form.invalid_size_or_type')}}">
                                @if ($errors->has('about_foto')){{ $errors->first('about_foto') }}@endif
                            </div>
                            <div class="text-muted" id="about_foto_help">{{trans("admin/form.file_extension_limit")}}.jpg,.jpeg,.png,.webp. {{trans("admin/form.image_recommended")}}{{trans("admin/form.image_width")}}1920px, {{trans("admin/form.image_height")}}1080px. {{trans("admin/form.image_image_action")}}{{trans("admin/form.image_image_action_resize")}}.</div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="about2">Hakkımızda başlık iki</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="about2" autocomplete="off"
                                   name="about2"  placeholder="Hakkımızda başlık iki"
                                   value="{{{ old('about2', $data->about2??'') }}}">
                            <div class="error-message @if ($errors->has('about2')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="about2_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-textarea">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="about_top_desc_2">Hakkımızda üst açıklama 2</label>
                        </div>
                        <div class="input-data">
                            <textarea class="form-input form-textarea js-ak-tiny-mce-simple-text-editor" id="about_top_desc_2" data-height="250" style="height:250px" name="about_top_desc_2"  placeholder="Hakkımızda &uuml;st a&ccedil;ıklama 2">{{{ old('about_top_desc_2', $data->about_top_desc_2??'') }}}</textarea>
                            <div class="error-message @if ($errors->has('about_top_desc_2')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="about_top_desc_2_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-textarea">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="about_down_desc_2">Hakkımızda alt açıklama 2</label>
                        </div>
                        <div class="input-data">
                            <textarea class="form-input form-textarea " id="about_down_desc_2" data-height="250" style="height:250px" name="about_down_desc_2"  placeholder="Hakkımızda alt a&ccedil;ıklama 2">{{{ old('about_down_desc_2', $data->about_down_desc_2??'') }}}</textarea>
                            <div class="error-message @if ($errors->has('about_down_desc_2')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="about_down_desc_2_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-image">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="about_foto_2">Hakkımızda foto 2</label>
                        </div>
                        <div class="input-data">
                            @if ($data->about_foto_2)
                                <div>
                                    <a href="{{ $data->about_foto_2 }}" target="_blank" class="form-image-preview js-ak-about_foto_2-available">
                                        <img src="{{ $data->about_foto_2 }}">
                                    </a>
                                </div>
                                <div>
                                    <label for="ak_about_foto_2_delete" class="checkbox-input">
                                        <input class="form-checkbox" type="checkbox" name="ak_about_foto_2_delete" id="ak_about_foto_2_delete" value="1">
                                        {{trans('admin/form.remove_file')}}
                                    </label>
                                </div>
                            @elseif(isset($data->about_foto_2) && $data->getRawOriginal("about_foto_2"))
                                <div class="alert-info-container">
                                    <div>'{{$data->getRawOriginal("about_foto_2")}}' {{trans('admin/form.file_location_error')}}</div>
                                </div>
                            @endif
                            <input type="file" class="form-file js-ak-image-upload" data-id="about_foto_2" accept=".jpg,.jpeg,.png,.webp" data-file-type=".jpg,.jpeg,.png,.webp"  name="about_foto_2"  data-selected="{{trans('admin/form.image_preview')}}" >
                            <input type="hidden" name="ak_about_foto_2_current" value="{{$data->getRawOriginal("about_foto_2")??''}}">
                            <div class="error-message @if ($errors->has('about_foto_2')) show @endif" data-required="{{trans('admin/form.required_image')}}" data-size="{{trans('admin/form.required_size')}}" data-type="{{trans('admin/form.required_type')}}" data-size-type="{{trans('admin/form.invalid_size_or_type')}}">
                                @if ($errors->has('about_foto_2')){{ $errors->first('about_foto_2') }}@endif
                            </div>
                            <div class="text-muted" id="about_foto_2_help">{{trans("admin/form.file_extension_limit")}}.jpg,.jpeg,.png,.webp. {{trans("admin/form.image_recommended")}}{{trans("admin/form.image_width")}}1920px, {{trans("admin/form.image_height")}}1080px. {{trans("admin/form.image_image_action")}}{{trans("admin/form.image_image_action_resize")}}.</div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="call_to_action_title">İletişime geç başlık</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="call_to_action_title" autocomplete="off"
                                   name="call_to_action_title"  placeholder="İletişime ge&ccedil; başlık"
                                   value="{{{ old('call_to_action_title', $data->call_to_action_title??'') }}}">
                            <div class="error-message @if ($errors->has('call_to_action_title')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="call_to_action_title_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-text">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="call_to_action_alt_title">İletişime geç alt başlık</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="call_to_action_alt_title" autocomplete="off"
                                   name="call_to_action_alt_title"  placeholder="İletişime ge&ccedil; alt başlık"
                                   value="{{{ old('call_to_action_alt_title', $data->call_to_action_alt_title??'') }}}">
                            <div class="error-message @if ($errors->has('call_to_action_alt_title')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="call_to_action_alt_title_help"></div>
                        </div>
                    </div>
                </div>
        </div>
        @includeIf("admin.admin_layout.partials.form.footer",["cancel_route"=>route("admin.fixed_content.index")])
    </form>
</div>
@isset($data->id)
    @includeIf("admin.admin_layout.partials.delete_modal_confirm")
@endisset
@endsection