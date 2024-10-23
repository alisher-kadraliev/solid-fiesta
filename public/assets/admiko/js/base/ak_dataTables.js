/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkDataTables {
    constructor() {
        this.initDataTables();
        this.startSearch();
        this.singleDelete();
        this.submitDelete();
        this.multiDelete();
    }
    initDataTables() {
        let self = this;
        if ($(".js-ak-DataTable").find(".js-ak-content").length) {
            $.extend($.fn.dataTableExt.oStdClasses, {
                "sLengthSelect": "form-select"
            });
            $('.js-ak-DataTable').each(function () {
                self.setDataTables($(this));
            })
        }
    }
    startSearch() {
        let self = this;
        $('.js-ak-DataTable').on('submit', '.js-ak-ajax-search', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-DataTable");
            let send_to = parent.data('call-ajax-url');
            let data = $(this).serialize() + '&ajax_call=1';
            self.getData(parent, send_to, data);
        })
    }
    setDataTables(parent) {
        parent.ak_tableSearch = parent.find(".js-ak-content").DataTable({
            dom: 'ltrip',
            "language": {
                "paginate": {
                    "next": "&raquo;",
                    "previous": "&laquo;"
                },
                sLengthMenu: "_MENU_",
                sInfoFiltered: "",
                sInfoEmpty: "",
                sInfo: dataTable_table_info,
                "sEmptyTable": dataTable_no_records
            },
            "searchDelay": 350,
            "lengthMenu": lengthMenu,
            "order": [],
            initComplete: (settings) => {
                $(settings.nTableWrapper).closest(".js-ak-DataTable").find('.dataTables_length').appendTo(parent.find('.js-ak-table-length-DataTable'));
                $(settings.nTableWrapper).closest(".js-ak-DataTable").find('.dataTables_info').appendTo(parent.find('.js-ak-pagination-info'));
                $(settings.nTableWrapper).closest(".js-ak-DataTable").find('.dataTables_paginate').appendTo(parent.find('.js-ak-pagination-box'));
            },
            "fnDrawCallback": function (settings) {
                if (settings._iDisplayLength >= settings.fnRecordsDisplay()) {
                    parent.find('.dataTables_paginate').hide();
                } else {
                    parent.find('.dataTables_paginate').show();
                }
            }
        });
        parent.find(".js-ak-search-input").on("keyup", function () {
            parent.ak_tableSearch.search($(this).val()).draw();
        })
    }

    // use ajax
    enableModalDeleteButton(form) {
        form.find('.js-ak-submit-button').attr("disabled", false)
    }

    disableModalDeleteButton(form) {
        form.find('.js-ak-submit-button').attr("disabled", true);
    }

    singleDelete() {
        $('.js-ak-ajax-DataTable-container').on('click', '.js-ak-delete-link', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-DataTable-container");
            parent.find(".js-ak-ajax-modal-delete .js-ak-modal-form").prop("action", parent.data("delete-modal-action"));
            let modal_box = parent.find('.js-ak-ajax-modal-delete .js-ak-modal-collect-data');
            modal_box.html('');
            $('<input>').attr({
                type: 'hidden',
                value: $(this).data("id"),
                name: 'delete_id[]'
            }).appendTo(modal_box);
            parent.find('.js-ak-ajax-modal-delete').fadeIn(150);
        })
    }

    multiDelete() {
        let self = this;
        $('.js-ak-ajax-DataTable-container').on('click', '.js-ak-toggle-delete-select', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-DataTable-container")
            parent.find(".js-ak-delete-select-me").prop("checked", !parent.find(".js-ak-delete-select-me").prop("checked"));
            self.showMultiDeleteButton(parent);
        }).on('click', '.js-ak-delete-select-me', function (event) {
            let parent = $(this).closest(".js-ak-ajax-DataTable-container");
            self.showMultiDeleteButton(parent);
        }).on('click', '.js-ak-multi-delete-start', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-DataTable-container");
            if (parent.find(".js-ak-delete-select-me:checked").length > 0) {
                parent.find(".js-ak-ajax-modal-delete .js-ak-modal-form").prop("action", parent.data("delete-modal-action"));
                let modal_box = parent.find('.js-ak-ajax-modal-delete .js-ak-modal-collect-data');
                modal_box.html('');
                parent.find(".js-ak-delete-select-me:checked").each(function () {
                    $('<input>').attr({
                        type: 'hidden',
                        value: $(this).val(),
                        name: 'delete_id[]'
                    }).appendTo(modal_box);
                })
                // parent.find('.js-ak-ajax-modal-delete').fadeIn(150);
                parent.find('.js-ak-ajax-modal-delete').fadeIn(150);
            }
        });
    }

    showMultiDeleteButton(parent) {
        if (parent.find(".js-ak-delete-select-me:checked").length > 0) {
            parent.find(".js-ak-multi-delete-start").show();
        } else {
            parent.find(".js-ak-multi-delete-start").hide();
        }
    }

    submitDelete() {
        let self = this;
        $('.js-ak-ajax-DataTable-container').on('submit', '.js-ak-ajax-modal-delete form', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-DataTable-container");
            let delete_url = parent.data("delete-modal-action");
            let data = $(this).serialize() + '&ajax_call=1';
            self.disableModalDeleteButton(parent);
            self.deleteData(parent, delete_url, data);
        })
    }

    deleteData(parent, delete_url, data) {
        let self = this;
        $.ajax({
            url: delete_url,
            type: 'POST',
            data: data,
            dataType: 'JSON',
            success: function (data) {
                if (data.success) {
                    self.enableModalDeleteButton(parent);
                    parent.find('.js-ak-ajax-modal-delete').fadeOut(100);
                    ToastStart.success(data.message);
                    self.cleanRows(parent);
                } else {
                    self.enableModalDeleteButton(parent);
                    ToastStart.error(data.message);
                }
            },
            error: function () {
                ToastStart.error(server_side_error_message);
            },
        });
    }

    cleanRows(parent) {
        let self = this;
        parent.find('.js-ak-ajax-modal-delete .js-ak-modal-collect-data input').each(function (e) {
            let remove_row = "";
            if (parent.find(".js-ak-delete-select-me:checked").length > 0) {
                parent.find(".js-ak-delete-select-me:checked").each(function () {
                    remove_row = $(this).closest('tr');
                    parent.find('.js-ak-content').DataTable().row(remove_row).remove().draw("full-hold");
                })
                self.showMultiDeleteButton(parent);
            } else {
                remove_row = parent.find(".js-ak-delete-link[data-id='" + $(this).val() + "']").closest('tr');
                parent.find('.js-ak-content').DataTable().row(remove_row).remove().draw("full-hold");
            }
        })
    }

    reloadDropZone(id) {
        let parent = $(".js-ak-ajax-DataTable-container[data-id='" + id + "']");
        let send_to = parent.data('ajax-call-url');
        let data = "ajax_call=1";
        this.getData(parent, send_to, data);
    }

    getData(parent, send_to, data) {
        let self = this;
        parent.find(".js-ak-ajax-spinner").fadeIn(50);
        $.ajax({
            url: send_to,
            type: 'GET',
            data: data,
            dataType: 'html',
            success: function (result) {
                let search = $(result).find(".js-ak-ajax-search");
                let table = $(result).find(".js-ak-ajax-content");
                if (search.length > 0) {
                    parent.find('.js-ak-ajax-search').replaceWith($(result).find(".js-ak-ajax-search"));
                }
                if (table.length > 0) {
                    parent.find(".js-ak-pagination-info").html("");
                    parent.find(".js-ak-pagination-box").html("");
                    parent.find(".js-ak-table-length-DataTable").html("");
                    parent.find('.js-ak-ajax-content').replaceWith($(result).find(".js-ak-ajax-content"));
                    self.setDataTables(parent);
                }
                self.showMultiDeleteButton(parent);
                parent.find(".js-ak-ajax-spinner").fadeOut(150);
            },
            error: function (data) {
                ToastStart.error(server_side_error_message);
            },
        });
    }
}
