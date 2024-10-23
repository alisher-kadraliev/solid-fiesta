{{--This file is managed by Admiko and is not recommended to be modified since it may be overwritten during Admiko updates.--}}
@extends("admin.admin_layout.default")
@section('breadcrumbs')
    <li class="breadcrumb-item">{{ trans('admin/admin_service/admin_import.title') }}</li>
@endsection
@section('page-title')
    {{ trans('admin/admin_service/admin_import.title') }}
@endsection
@section('page-info')
    {{ trans('admin/admin_service/admin_import.info') }}
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
    @if($data->update??false)
        <div class="content-layout content-width-small">
            <div class="content-element">
                <div class="content-header">
                    <div class="header">
                        <h3 class="title">{{ trans('admin/admin_service/admin_import.update') }}</h3>
                        <p class="table-header-info">{{ trans('admin/admin_service/admin_import.import_info') }} v.{{config("admin.version.version","")}}</p>
                    </div>
                    <div class="action">
                        <div class="left"></div>
                        <div class="right"></div>
                    </div>
                </div>
                <div>
                    <div class="text-muted">{!!$data->update!!}</div>
                    <br>
                    <form method="post" action="{{route("admin.ak_admin_import.update")}}">
                        <div hidden>
                            @method('POST')
                            @csrf
                        </div>
                        <div>
                            <div class="row js-import-form">
                                <div class="js-ak-data-import"></div>
                                <button type="submit" class="button primary-button">
                                    <div class="icon">
                                        <div class="font-awesome-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                <path d="M144 480C64.47 480 0 415.5 0 336C0 273.2 40.17 219.8 96.2 200.1C96.07 197.4 96 194.7 96 192C96 103.6 167.6 32 256 32C315.3 32 367 64.25 394.7 112.2C409.9 101.1 428.3 96 448 96C501 96 544 138.1 544 192C544 204.2 541.7 215.8 537.6 226.6C596 238.4 640 290.1 640 352C640 422.7 582.7 480 512 480H144zM223 263C213.7 272.4 213.7 287.6 223 296.1C232.4 306.3 247.6 306.3 256.1 296.1L296 257.9V392C296 405.3 306.7 416 320 416C333.3 416 344 405.3 344 392V257.9L383 296.1C392.4 306.3 407.6 306.3 416.1 296.1C426.3 287.6 426.3 272.4 416.1 263L336.1 183C327.6 173.7 312.4 173.7 303 183L223 263z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    {{trans('admin/admin_service/admin_import.update_button')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="alert-info-container">
                    <div>{{trans('admin/admin_service/admin_import.update_backup_info')}} /{{config("admin.settings.backup_folder","")}}</div>
                </div>
            </div>
        </div>
    @endif
    @if($data->all_pages??false)
        <div class="content-layout content-width-small">
            <div class="content-element">
                <div class="content-header" style="justify-content: space-between;flex-direction: row;">
                    <div class="header">
                        <h3 class="title">{{ trans('admin/admin_service/admin_import.import_title') }}</h3>
                        <p class="info">{{ trans('admin/admin_service/admin_import.import_info') }} v.{{config("admin.version.version","")}}</p>
                    </div>
                    <div class="action">
                        <div style="max-width: 200px">
                            <a href="{{route('admin.ak_admin_languages')}}" class="button primary-button languages-btn" draggable="false">
                                <div class="icon">
                                    <div class="font-awesome-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M266.3 48.3L232.5 73.6c-5.4 4-8.5 10.4-8.5 17.1v9.1c0 6.8 5.5 12.3 12.3 12.3c2.4 0 4.8-.7 6.8-2.1l41.8-27.9c2-1.3 4.4-2.1 6.8-2.1h1c6.2 0 11.3 5.1 11.3 11.3c0 3-1.2 5.9-3.3 8l-19.9 19.9c-5.8 5.8-12.9 10.2-20.7 12.8l-26.5 8.8c-5.8 1.9-9.6 7.3-9.6 13.4c0 3.7-1.5 7.3-4.1 10l-17.9 17.9c-6.4 6.4-9.9 15-9.9 24v4.3c0 16.4 13.6 29.7 29.9 29.7c11 0 21.2-6.2 26.1-16l4-8.1c2.4-4.8 7.4-7.9 12.8-7.9c4.5 0 8.7 2.1 11.4 5.7l16.3 21.7c2.1 2.9 5.5 4.5 9.1 4.5c8.4 0 13.9-8.9 10.1-16.4l-1.1-2.3c-3.5-7 0-15.5 7.5-18l21.2-7.1c7.6-2.5 12.7-9.6 12.7-17.6c0-10.3 8.3-18.6 18.6-18.6H400c8.8 0 16 7.2 16 16s-7.2 16-16 16H379.3c-7.2 0-14.2 2.9-19.3 8l-4.7 4.7c-2.1 2.1-3.3 5-3.3 8c0 6.2 5.1 11.3 11.3 11.3h11.3c6 0 11.8 2.4 16 6.6l6.5 6.5c1.8 1.8 2.8 4.3 2.8 6.8s-1 5-2.8 6.8l-7.5 7.5C386 262 384 266.9 384 272s2 10 5.7 13.7L408 304c10.2 10.2 24.1 16 38.6 16H454c6.5-20.2 10-41.7 10-64c0-111.4-87.6-202.4-197.7-207.7zm172 307.9c-3.7-2.6-8.2-4.1-13-4.1c-6 0-11.8-2.4-16-6.6L396 332c-7.7-7.7-18-12-28.9-12c-9.7 0-19.2-3.5-26.6-9.8L314 287.4c-11.6-9.9-26.4-15.4-41.7-15.4H251.4c-12.6 0-25 3.7-35.5 10.7L188.5 301c-17.8 11.9-28.5 31.9-28.5 53.3v3.2c0 17 6.7 33.3 18.7 45.3l16 16c8.5 8.5 20 13.3 32 13.3H248c13.3 0 24 10.7 24 24c0 2.5 .4 5 1.1 7.3c71.3-5.8 132.5-47.6 165.2-107.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM187.3 100.7c-6.2-6.2-16.4-6.2-22.6 0l-32 32c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0l32-32c6.2-6.2 6.2-16.4 0-22.6z"/></svg>
                                    </div>
                                </div>
                                {{ trans('admin/admin_service/admin_import.lang_title') }}
                            </a>
                        </div>
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
                            <th>{{trans('admin/admin_service/admin_import.page_name')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($data->all_pages))
                            @foreach($data->all_pages as $row)
                                <tr>
                                    <td class="manage-col">
                                        <div style="display: flex;justify-content: center;align-items: center">
                                            <input type="checkbox" value="{{$row->id}}" class="form-checkbox js-ak-import-select-me" id="page_{{$row->id}}">
                                        </div>
                                    </td>
                                    <td><label for="page_{{$row->id}}" style="cursor: pointer;user-select: none">{{{$row->title}}}</label></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div>
                    <div>
                        <form method="post" action="{{route("admin.ak_admin_import.pages")}}">
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
            totalPages = form.find('.js-ak-data-import input').length + 1;
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
                url: '{{route("admin.ak_admin_import.pages")}}',
                type: 'post',
                data: {'page_id[]': data[i]['value'], '_token': form.find("input[name=_token]").val(), 'backup_folder': backup_folder},
                dataType: 'json',
                success: function (results) {
                    if (results.success === true) {
                        backup_folder = results.backup_folder;
                        i++;
                        if (data.length > i) {
                            startImport(data, i, form)
                        } else {
                            refreshFiles(form)
                        }
                    } else {
                        form.find('.js-ak-error-info div').text(results.message).parent().slideDown();
                        showImportButton();
                    }
                },
                error: function () {
                    form.find('.js-ak-error-info div').text("Invalid response.").parent().slideDown();
                    showImportButton();
                }
            });
        }

        function refreshFiles(form) {
            totalPagesFinished++;
            progress = (totalPagesFinished / totalPages) * 100;
            form.find('.js-ak-progress-bar').css('width', progress + '%');
            $.ajax({
                url: '{{route("admin.ak_admin_import.refresh")}}',
                type: 'post',
                data: {'_token': form.find("input[name=_token]").val(), 'backup_folder': backup_folder},
                dataType: 'json',
                success: function (results) {
                    if (results.success === true) {
                        form.find('.js-ak-progress').hide();
                        form.find('.js-ak-progress-bar').css('width', '0');
                        form.find('.js-ak-import-finished').slideDown();
                    } else {
                        form.find('.js-ak-error-info div').text(results.message).parent().slideDown();
                    }
                },
                error: function () {
                    form.find('.js-ak-error-info div').text('Invalid response.').parent().slideDown();
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
