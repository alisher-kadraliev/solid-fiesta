{{--This file is managed by Admiko and is not recommended to be modified since it may be overwritten during Admiko updates.--}}
@extends("admin.admin_layout.default")
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{route('admin.ak_admin_import')}}">{{ trans('admin/admin_service/admin_import.title') }}</a></li>
    <li class="breadcrumb-item">{{ trans('admin/admin_service/admin_import.lang_title') }}</li>
@endsection
@section('page-title')
    {{ trans('admin/admin_service/admin_import.lang_title') }}
@endsection
@section('page-info')
    {{ trans('admin/admin_service/admin_import.lang_info') }}
@endsection
@section('page-back-button')@endsection

@section('page-content')
    @if ($error??false)
        <div class="content-layout content-width-small">
            <div class="alert-danger-container">
                <ul>
                    <li>{!!$error!!}</li>
                </ul>
            </div>
        </div>
    @endif
    @if($data->langauges??false)
        <div class="content-layout content-width-small">
            <div class="content-element">
                <div class="content-header">
                    <div class="header">
                        <h3 class="title">{{ trans('admin/admin_service/admin_import.lang_import_title') }}</h3>
                        <p class="info">{{ trans('admin/admin_service/admin_import.import_info') }} v.{{config("admin.version.version","")}}</p>
                    </div>
                    <div class="action">
                        <div class="left"></div>
                        <div class="right"></div>
                    </div>
                </div>
                <div class="content table-content js-ak-table-content">
                    <table class="table">
                        <thead>
                        <tr style="user-select: none">
                            <th class="no-sort manage-col" style="width:45px!important;padding: 0.125rem">
                                <div class="manage-links" style="justify-content: center;cursor: pointer">
                                    <div class="js-ak-import-select-all">
                                        <div class="delete-select-all">
                                            <div class="icon">
                                                <div class="font-awesome-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path d="M374.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 178.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l80 80c12.5 12.5 32.8 12.5 45.3 0l160-160zm96 128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 402.7 86.6 297.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l256-256z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th>{{trans('admin/admin_service/admin_import.lang_page_name')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($data->langauges))
                            @foreach($data->langauges as $row)
                                <tr>
                                    <td class="manage-col">
                                        <div style="display: flex;justify-content: center;align-items: center">
                                            <input type="checkbox" value="{{$row->code}}" class="form-checkbox js-ak-import-select-me" id="lang_{{$row->code}}">
                                        </div>
                                    </td>
                                    <td><label for="lang_{{$row->code}}" style="cursor: pointer;user-select: none">{{{$row->title}}}</label></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div>
                    <div>
                        <form method="post">
                            @method('POST')
                            @csrf
                            <div class="row js-import-form">
                                <div class="js-ak-data-import"></div>
                                <button type="submit" class="button primary-button js-ak-start-import" disabled>
                                    <div class="icon">
                                        <div class="font-awesome-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                <path d="M144 480C64.47 480 0 415.5 0 336C0 273.2 40.17 219.8 96.2 200.1C96.07 197.4 96 194.7 96 192C96 103.6 167.6 32 256 32C315.3 32 367 64.25 394.7 112.2C409.9 101.1 428.3 96 448 96C501 96 544 138.1 544 192C544 204.2 541.7 215.8 537.6 226.6C596 238.4 640 290.1 640 352C640 422.7 582.7 480 512 480H144zM223 263C213.7 272.4 213.7 287.6 223 296.1C232.4 306.3 247.6 306.3 256.1 296.1L296 257.9V392C296 405.3 306.7 416 320 416C333.3 416 344 405.3 344 392V257.9L383 296.1C392.4 306.3 407.6 306.3 416.1 296.1C426.3 287.6 426.3 272.4 416.1 263L336.1 183C327.6 173.7 312.4 173.7 303 183L223 263z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    {{trans('admin/admin_service/admin_import.import_button')}}
                                </button>
                            </div>
                            <div style="padding: 12px 0">
                                <div class="alert-success-container js-ak-import-finished" style="display:none;">
                                    <div>
                                        {{trans('admin/admin_service/admin_import.import_finished')}}
                                    </div>
                                </div>
                                <div class="alert-danger-container js-ak-error-info" style="display:none;">
                                    <div></div>
                                </div>
                                <div class="js-ak-progress" style="padding: 12px 0;display:none;">
                                    <div class="progress">
                                        <div class="progress-bar js-ak-progress-bar" style="width: 0"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="alert-info-container">
                            <div>{{trans('admin/admin_service/admin_import.update_backup_info')}} /{{ config("admin.settings.backup_folder","")}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('footer_stack_bottom')
    <script>
        $('.js-ak-table-content').on('click', '.js-ak-import-select-all', function (event) {
            event.preventDefault();
            let checkBoxes = $(".js-ak-import-select-me");
            checkBoxes.prop("checked", !checkBoxes.prop("checked"));
            showImportButton();
        });
        $('.js-ak-table-content').on('click', '.js-ak-import-select-me', function (event) {
            showImportButton();
        });

        $('.js-ak-start-import').on('click', function (event) {
            event.preventDefault();
            backup_folder = '';
            var form = $(this).closest('form');
            form.find('.js-ak-progress').slideDown();
            form.find('.js-ak-progress-bar').css('width', '0');
            form.find('.js-ak-import-finished').slideUp();
            form.find('.js-ak-error-info').slideUp();
            $(".js-ak-start-import").prop("disabled", true);
            totalPages = form.find('.js-ak-data-import input').length;
            totalPagesFinished = 0;
            progress = 0;
            startImport(form.find('.js-ak-data-import input').serializeArray(), 0, form);
        });

        var totalPages = 0;
        var totalPagesFinished = 0;
        var progress = 0;
        var backup_folder = '';

        function startImport(data, i, form) {
            totalPagesFinished++;
            progress = (totalPagesFinished / totalPages) * 100;
            form.find('.js-ak-progress-bar').css('width', progress + '%');

            $.ajax({
                url: '{{route("admin.ak_admin_languages.import")}}',
                type: 'post',
                data: {'lang_id[]': data[i]['value'], '_token': form.find("input[name=_token]").val(), 'backup_folder': backup_folder},
                dataType: 'json',
                success: function (results) {
                    if (results.success === true) {
                        backup_folder = results.backup_folder;
                        i++;
                        if (data.length > i) {
                            startImport(data, i, form)
                        } else {
                            form.find('.js-ak-progress').hide();
                            form.find('.js-ak-progress-bar').css('width', '0');
                            form.find('.js-ak-import-finished').slideDown();
                        }
                    } else {
                        form.find('.js-ak-error-info div').text(results.message).parent().slideDown();
                        showImportButton();
                    }
                },
                error: function () {
                    form.find('.js-ak-error-info div').text("Invalid response.").parent().slideDown();
                    showImportButton();
                },
                complete:function(){
                    showImportButton();
                }
            });
        }

        function showImportButton() {
            if ($(".js-ak-import-select-me:checked").length > 0) {
                $('.js-ak-data-import').html('');
                $(".js-ak-import-select-me:checked").each(function (i) {
                    importId = $(this).val();
                    $('<input>').attr({
                        type: 'hidden',
                        value: importId,
                        name: 'page_id[]'
                    }).appendTo('.js-ak-data-import');
                })
                $(".js-ak-start-import").prop("disabled", false);
            } else {
                $(".js-ak-start-import").prop("disabled", true);
            }
        }
    </script>
@endpush
