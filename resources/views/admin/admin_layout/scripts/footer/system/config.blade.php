{{--
Note: To avoid overwriting, it is recommended to add your custom code using files inside /resource/views/admin/admin_layout/scripts/footer/custom/ folder.
--}}
<script>
    let csrf_token = "{{ csrf_token() }}";
    let dataTable_no_records = '{{trans('admin/table.dataTable_no_records')}}';
    let dataTable_table_info = '{{trans('admin/table.dataTable_table_info')}}';
    let lengthMenu = {!!config("admin.table.length_menu_DataTables",0)!!};
    let success_upload_message = '{{trans('admin/misc.success_confirmation_uploaded')}}';
    let server_side_error_message = '{{trans('admin/misc.js_server_error')}}';
    let flatPickerSettings = {
        locale: {!!trans('admin/config/date_time_flatpickr.locale')!!},
        rangeSeparator: "{!!trans('admin/config/date_time_flatpickr.rangeSeparator')!!}",
        date_format: "{!!trans('admin/config/date_time.js_date_format')!!}",
        date_time_format: "{!!trans('admin/config/date_time.js_date_time_format')!!}",
        time_format: "{!!trans('admin/config/date_time.js_time_format')!!}",
    };
    let widget_lang = {
        total: "{!!trans('admin/misc.widgets_count')!!}",
        loading: "{!!trans('admin/misc.widgets_loading')!!}",
        no_results: "{!!trans('admin/misc.widgets_no_results')!!}",
    };
</script>
