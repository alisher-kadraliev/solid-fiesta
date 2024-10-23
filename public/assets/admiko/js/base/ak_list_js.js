/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkListJs {
    constructor() {
        this.initContent();
        this.startSearch();
        this.singleDelete();
        this.submitDelete();
        this.multiDelete();
    }

    initContent() {

        let self = this;
        $(".js-ak-listjs").each(function () {
            self.setListJs($(this).closest(".js-ak-listjs"));
        })
    }

    setListJs(parent) {
        if (parent.find('.js-ak-item-container').length > 0) {
            parent.find('.js-ak-pagination-info').show();
            let valueNames = [];
            parent.find('.js-ak-item-container:first [class*="js-ak-search-by-"]').each(function (i, el) {
                let name = (el.className.match(/(^|\s)(js\-ak\-search\-by\-[^\s]*)/) || [, , ''])[2];
                if (name) {
                    valueNames.push(name);
                }
            });

            let options = {
                searchDelay: 350,
                valueNames: valueNames,
                searchClass: 'js-ak-search-input',
                listClass: 'js-ak-content',
                page: parent.find('.js-ak-table-length-listjs').val(),
                pagination: [{
                    name: "listjs-pagination",
                    paginationClass: "listjs-pagination",
                    outerWindow: 1,
                    item: "<li class='page-item'><span class='page-link page'></span></li>",
                }]
            };

            parent.listjs = new List(parent[0], options);

            setPaginationInfo(parent);

            parent.listjs.on('updated', function (list) {
                setPaginationInfo(parent);
            });

            function setPaginationInfo(parent) {
                let total = parseInt(parent.listjs.i) - 1 + parseInt(parent.listjs.page);
                if (total > parent.listjs.matchingItems.length) {
                    total = parent.listjs.matchingItems.length;
                }
                parent.find('.js-ak-from').text(parent.listjs.i);
                parent.find('.js-ak-to').text(total);
                parent.find('.js-ak-total').text(parent.listjs.size());
            }

            parent.find('.js-ak-table-length-listjs').on('change', function () {
                parent.listjs.page = $(this).val();
                parent.listjs.update();
                parent.listjs.show(1, parent.listjs.page);
            });
        } else {
            parent.find('.js-ak-pagination-info').hide();
        }
    }

    // use ajax
    startSearch() {
        let self = this;
        $('.js-ak-ajax-listjs-container').on('submit', '.js-ak-ajax-search', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-listjs-container");
            let send_to = parent.data('ajax-call-url');
            let data = $(this).serialize() + '&ajax_call=1';
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
        $('.js-ak-ajax-listjs-container').on('click', '.js-ak-delete-link', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-listjs-container");
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
        $('.js-ak-ajax-listjs-container').on('click', '.js-ak-toggle-delete-select', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-listjs-container")
            parent.find(".js-ak-delete-select-me").prop("checked", !parent.find(".js-ak-delete-select-me").prop("checked"));
            self.showMultiDeleteButton(parent);
        }).on('click', '.js-ak-delete-select-me', function (event) {
            let parent = $(this).closest(".js-ak-ajax-listjs-container");
            self.showMultiDeleteButton(parent);
        }).on('click', '.js-ak-multi-delete-start', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-listjs-container");
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
        $('.js-ak-ajax-listjs-container').on('submit', '.js-ak-ajax-modal-delete form', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-ajax-listjs-container");
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
        let parent = $(".js-ak-ajax-listjs-container[data-id='" + id + "']");
        let send_to = parent.data('ajax-call-url');
        let data = "ajax_call=1";
        this.getData(parent, send_to, data);
    }

    reloadData(parent) {
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
                    parent.find('.js-ak-ajax-content').replaceWith($(result).find(".js-ak-ajax-content"));
                    self.setListJs(parent)
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

