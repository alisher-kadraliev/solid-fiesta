@extends("admin.admin_layout.default")
@section('breadcrumbs')
<li class="breadcrumb-item active">Sabit içerik yönetimi</li>
@endsection
@section('page-title')
Sabit içerik yönetimi
@endsection
@section('page-info')@endsection
@section('page-back-button')@endsection
@section('page-content')
<div class="page-content-width-full">
    
	@can("fixed_content_access")
    <div class="content-layout content-width-full fixed-content-data-content js-ak-DataTable js-ak-delete-container js-ak-content-layout"
        data-id="fixed_content"
        data-delete-modal-action="{{route("admin.fixed_content.delete")}}">
        <div class="content-element">
            <div class="content-header">
                <div class="header">
                    <h3></h3>
                    <p class="info"></p>
                </div>
                <div class="action">
                    <div class="left">
                        <form class="search-container" ><input name="fixed_content_source" value="fixed_content" type="hidden"/><input name="fixed_content_length" value="{{Request()->query("fixed_content_length")}}" type="hidden"/>
                            <div class="search">
                                <input type="text" autocomplete="off" placeholder="{{trans('admin/table.search')}}" name="fixed_content_search" value="{{(Request()->query("fixed_content_source") == "fixed_content")?Request()->query("fixed_content_search")??"":""}}" class="form-input js-ak-search-input">
                                <button class="search-button" draggable="false">
                                    @includeIf("admin/admin_layout/partials/misc/icons/search_icon")
                                </button>
                                @if(Request()->query("fixed_content_source") == "fixed_content" && Request()->query("fixed_content_search"))
                                    <div class="reset-search js-ak-reset-search">
                                        @includeIf("admin/admin_layout/partials/misc/icons/reset_search_icon")
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="right">
                        @canany('fixed_content_create')
                        <a href="{{route('admin.fixed_content.create')}}" class="button primary-button add-new" draggable="false">
                            @includeIf("admin/admin_layout/partials/misc/icons/add_new_icon")
                            {{trans('admin/table.add_new')}}
                        </a>
                        @endcanany
                    </div>
                </div>
            </div>
            <div class="content table-content">
                <table class="table js-ak-content">
                <thead>
                    <tr data-sort-method='thead'>
						<th class="table-id" data-sort-method="number">ID</th>
						<th>Başlık</th>
                        @canany(['fixed_content_edit','fixed_content_delete'])
                        <th class="no-sort manage-th" data-orderable="false">
                            <div class="manage-links">
                                
                            </div>
                        </th>
                        @endcanany
                    </tr>
                </thead>
                <tbody class="">
                @forelse($fixed_content_list_all as $data)
                    <tr>
						<td>
							{{$data->id}}
						</td>
						<td>
							{{$data->title}}
						</td>
                        @canany(['fixed_content_edit','fixed_content_delete'])
                        <td class="manage-td">
                            <div class="manage-links">
                                @can('fixed_content_edit')
                                    <a href="{{route("admin.fixed_content.edit", $data->id)}}" class="edit-link" draggable="false">@includeIf("admin/admin_layout/partials/misc/icons/edit_icon")</a>
                            @endcan
                                @can('fixed_content_delete')
                                <a href="#" data-id="{{$data->id}}" class="delete-link js-ak-delete-link" draggable="false">@includeIf("admin/admin_layout/partials/misc/icons/delete_icon")</a>
                                @endcan
                            </div>
                        </td>
                        @endcanany
                    </tr>
                @empty
                    
                @endforelse
                </tbody>
            </table>
            </div>
            <div class="content-footer">
                <div class="left">
                    <div class="change-length js-ak-table-length-DataTable"></div>
                </div>
                <div class="right">
                    <div class="content-pagination">
                        <nav class="pagination-container">
                            <div class="pagination-content">
                                <div class="pagination-info js-ak-pagination-info"></div>
                                <div class="pagination-box-data-table js-ak-pagination-box"></div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
	@endcan

	
	@includeIf("admin.admin_layout.partials.delete_modal_confirm")
</div>
@endsection