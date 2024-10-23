@extends("admin.admin_layout.default")
@section('breadcrumbs')
	<li class="breadcrumb-item"><a href="{{route("admin.home")}}">Markalar</a></li>
    @if(isset($data->id))
        <li class="breadcrumb-item active">{{trans('admin/form.breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active">{{trans('admin/form.breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('page-title')
Markalar
@endsection
@section('page-info')@endsection
@section('page-back-button')@endsection
@section('page-content')
<div class="form-container content-width-medium markalar-form-content js-ak-delete-container" data-delete-modal-action="{{route("admin.markalar.delete")}}">
    <form method="POST" action="@isset($data->id){{route("admin.markalar.update", $data->id)}}@else{{route("admin.markalar.store")}}@endisset" enctype="multipart/form-data" class="form-page validate-form" novalidate>
        <div hidden>
            @isset($data->id) @method('PUT') @endisset
            @csrf
        </div>
        <div class="form-header">
            <h3>{{ isset($data->id) ? trans('admin/form.update') : trans('admin/form.add_new') }}</h3>
        </div>
        @includeIf("admin.admin_layout.partials.form.errors")
        <div class="form-content">
            
        </div>
        @includeIf("admin.admin_layout.partials.form.footer",["cancel_route"=>route("admin.home")])
    </form>
</div>
@isset($data->id)
    @includeIf("admin.admin_layout.partials.delete_modal_confirm")
@endisset
@endsection