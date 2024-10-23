/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkDelete {
    constructor() {
        this.singleDelete();
        this.multiDelete();
    }
    singleDelete() {
        $('.js-ak-delete-container').on('click', '.js-ak-delete-link', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-delete-container");
            $(".js-ak-modal-form").prop("action", parent.data("delete-modal-action"));
            $('.js-ak-modal-collect-data').html('');
            $('<input>').attr({
                type: 'hidden',
                value: $(this).data("id"),
                name: 'delete_id[]'
            }).appendTo('.js-ak-modal-collect-data');
            $('.js-ak-modal-delete').fadeIn(150);
        })
    }

    multiDelete() {
        let self = this;
        $('.js-ak-delete-container').on('click', '.js-ak-toggle-delete-select', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-delete-container")
            parent.find(".js-ak-delete-select-me").prop("checked", !parent.find(".js-ak-delete-select-me").prop("checked"));
            self.showMultiDeleteButton(parent);
        }).on('click', '.js-ak-delete-select-me', function (event) {
            let parent = $(this).closest(".js-ak-delete-container");
            self.showMultiDeleteButton(parent);
        }).on('click', '.js-ak-multi-delete-start', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-delete-container");
            if (parent.find(".js-ak-delete-select-me:checked").length > 0) {
                $(".js-ak-modal-form").prop("action", parent.data("delete-modal-action"));
                $('.js-ak-modal-collect-data').html('');
                parent.find(".js-ak-delete-select-me:checked").each(function () {
                    $('<input>').attr({
                        type: 'hidden',
                        value: $(this).val(),
                        name: 'delete_id[]'
                    }).appendTo('.js-ak-modal-collect-data');
                })
                $('.js-ak-modal-delete').fadeIn(150);
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
}
