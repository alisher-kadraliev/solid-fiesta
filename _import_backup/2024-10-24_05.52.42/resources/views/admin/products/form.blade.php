@extends("admin.admin_layout.default")
@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{ route("admin.products.index") }}">Kategori Ürünler</a></li>
    @if(isset($data->id))
        <li class="breadcrumb-item active">{{trans('admin/form.breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active">{{trans('admin/form.breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('page-title')
Kategori Ürünler
@endsection
@section('page-info')@endsection
@section('page-back-button'){{ route("admin.products.index") }}@endsection
@section('page-content')
<div class="form-container content-width-medium products-form-content js-ak-delete-container" data-delete-modal-action="{{route("admin.products.delete")}}">
    <form method="POST" action="@isset($data->id){{route("admin.products.update", $data->id)}}@else{{route("admin.products.store")}}@endisset" enctype="multipart/form-data" class="form-page validate-form" novalidate>
        <div hidden>
            @isset($data->id) @method('PUT') @endisset
            @csrf
        </div>
        <div class="form-header">
            <h3>{{ isset($data->id) ? trans('admin/form.update') : trans('admin/form.add_new') }}</h3>
            <div class="form-delete-record">
                @can('products_delete')
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
                            <label for="product_categy_title">Ürün Kategori ismi</label>
                        </div>
                        <div class="input-data">
                            <input type="text" class="form-input" id="product_categy_title" autocomplete="off"
                                   name="product_categy_title"  placeholder="&Uuml;r&uuml;n Kategori ismi"
                                   value="{{{ old('product_categy_title', $data->product_categy_title??'') }}}">
                            <div class="error-message @if ($errors->has('product_categy_title')) show @endif">{{trans('admin/form.required_text')}}</div>
                            <div class="text-muted" id="product_categy_title_help"></div>
                        </div>
                    </div>
                </div>
                <div class="row-100 el-box-image">
                    <div class="input-container">
                        <div class="input-label">
                            <label for="image">Foto</label>
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
        </div>
        @includeIf("admin.admin_layout.partials.form.footer",["cancel_route"=>route("admin.products.index")])
    </form>
</div>
@isset($data->id)
    @includeIf("admin.admin_layout.partials.delete_modal_confirm")
@endisset
@endsection