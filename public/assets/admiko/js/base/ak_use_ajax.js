/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkUseAjax {
    constructor() {
        this.startSearch();
        this.startPagination();
        this.startLength();
        this.startSorting();
        this.singleDelete();
        this.multiDelete();
        this.submitDelete();
    }
    startSearch() {
        let self = this;
        $('.js-ak-ajax-container').on('submit', '.js-ak-ajax-search', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-container");
            let send_to = parent.data('ajax-call-url');
            let data = $(this).serialize() + '&ajax_call=1';
            self.getData(parent, send_to, data);
        })
    }

    startPagination() {
        let self = this;
        $('.js-ak-ajax-container').on('click', '.js-ak-ajax-pagination a.js-ak-page-link', function (event) {
            event.preventDefault();
            let link = $(this).attr('href');
            let parent = $(this).closest(".js-ak-ajax-container");
            let send_to = parent.data('ajax-call-url');
            let url = new URL(link);
            let data = url.search.substring(1) + '&ajax_call=1';
            self.getData(parent, send_to, data);
        })
    }

    startLength() {
        let self = this;
        $('.js-ak-ajax-container').on('change', '.js-ak-ajax-length', function (event) {
            event.preventDefault();
            let link = $(this).val();
            let parent = $(this).closest(".js-ak-ajax-container");
            let send_to = parent.data('ajax-call-url');
            let data = link.substring(1) + '&ajax_call=1';
            self.getData(parent, send_to, data);
        })
    }

    startSorting() {
        let self = this;
        $('.js-ak-ajax-container').on('click', '.js-ak-content th a.js-ak-th-sort', function (event) {
            event.preventDefault();
            let link = $(this).attr('href');
            let parent = $(this).closest(".js-ak-ajax-container");
            let send_to = parent.data('ajax-call-url');
            let data = link.substring(1) + '&ajax_call=1';
            self.getData(parent, send_to, data);
        })
    }

    enableModalDeleteButton(form) {
        form.find('.js-ak-submit-button').attr("disabled", false)
    }

    disableModalDeleteButton(form) {
        form.find('.js-ak-submit-button').attr("disabled", true);
    }

    singleDelete() {
        $('.js-ak-ajax-container').on('click', '.js-ak-delete-link', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-container");
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
        $('.js-ak-ajax-container').on('click', '.js-ak-toggle-delete-select', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-container")
            parent.find(".js-ak-delete-select-me").prop("checked", !parent.find(".js-ak-delete-select-me").prop("checked"));
            self.showMultiDeleteButton(parent);
        }).on('click', '.js-ak-delete-select-me', function () {
            let parent = $(this).closest(".js-ak-ajax-container");
            self.showMultiDeleteButton(parent);
        }).on('click', '.js-ak-multi-delete-start', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-container");
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
        $('.js-ak-ajax-container').on('submit', '.js-ak-ajax-modal-delete form', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-container");
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
                    self.reloadData(parent);
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

    reloadDropZone(id) {
        this.reloadData($(".js-ak-content-layout[data-id='" + id + "']"));
    }

    reloadData(parent) {
        let send_to = parent.data('ajax-call-url');
        let data = parent.find(".js-ak-ajax-active-query").val() + '&ajax_call=1';
        if (parent.find(".js-ak-ajax-active-query").length === 0) {
            data = "ajax_call=1";
        }
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
                let table = $(result).find(".js-ak-ajax-content");
                let length = $(result).find(".js-ak-ajax-length");
                let pagination = $(result).find(".js-ak-ajax-pagination");
                let search = $(result).find(".js-ak-ajax-search");
                let active_query = $(result).find(".js-ak-ajax-active-query");
                let table_header = $(result).find(".js-ak-content thead");
                if (search.length > 0) {
                    parent.find('.js-ak-ajax-search').replaceWith(search);
                }
                if (table_header.length > 0) {
                    parent.find('.js-ak-content thead').replaceWith(table_header);
                }
                if (table.length > 0) {
                    parent.find('.js-ak-ajax-content').html(table.html());
                }
                if (length.length > 0) {
                    parent.find('.js-ak-ajax-length').replaceWith(length);
                }
                if (pagination.length > 0) {
                    parent.find('.js-ak-ajax-pagination').replaceWith(pagination);
                }
                if (active_query.length > 0) {
                    parent.find('.js-ak-ajax-active-query').replaceWith(active_query);
                }
                self.showMultiDeleteButton(parent);
                parent.find(".js-ak-ajax-spinner").fadeOut(150);
            },
            error: function () {
                ToastStart.error(server_side_error_message);
            },
        });
    }
}
