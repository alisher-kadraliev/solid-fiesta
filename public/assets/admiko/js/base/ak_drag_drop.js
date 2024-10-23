/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkDragDrop {
    constructor() {
        this.Sorting();
    }
    Sorting() {
        let self = this;
        if ($('.js-ak-content-layout').find(".js-ak-table-sorting").length > 0) {
            $('.js-ak-content-layout').find(".js-ak-table-sorting").each(function () {
                self.startTableSorting($(this));
            })
        }
        if ($('.js-ak-content-layout').find(".js-ak-gallery-sorting").length > 0) {
            $('.js-ak-content-layout').find(".js-ak-gallery-sorting").each(function () {
                self.startGallerySorting($(this));
            })
        }
    }
    startTableSorting(element) {
        element.sortable({
            placeholder: 'highlight',
            items: '.js-ak-draggable',
            axis: 'y',
            handle: '.js-ak-drag-me',
            containment: element,
            forceHelperSize: true,
            forcePlaceholderSize: true,
            opacity: .8,
            tolerance: 'pointer',
            grid: [1, 1],
            helper: function (e, tr) {
                let helper = tr.clone();
                let originals = tr.children();
                helper.children().each(function (index) {
                    $(this).width(originals.eq(index).outerWidth(true));
                });
                return helper;
            },
            create: function (e, ui) {
                $(this).find('>tr>td').each(function (index) {
                    let org_w = $(this).width();
                    $(this).width(org_w)
                });
            },
            stop: function (event, ui) {
                let data_array = [];
                let send_to = $(this).closest('.js-ak-content-layout').data('save-sort-url');
                $(this).find('.js-ak-drag-me').each(function () {
                    data_array.push($(this).data('id'));
                });
                if (send_to && data_array.length > 0) {
                    $.ajax({
                        url: send_to,
                        type: 'POST',
                        data: {action: 'save_order', "sort_num_order": data_array, "_token": csrf_token},
                        dataType: 'JSON',
                        success: function (data) {
                            if (data.success) {
                                ToastStart.success(data.message);
                            } else {
                                ToastStart.error(data.message);
                            }
                        },
                        error: function () {
                            ToastStart.error(server_side_error_message);
                        },
                    });
                } else {
                    ToastStart.error(server_side_error_message);
                }

            }
        });
        $(window).resize(function () {
            $(element).find('>tr>td').width("").each(function (index) {
                let org_w = $(this).width();
                $(this).width(org_w)
            });
        });
    }

    startGallerySorting(element) {
        element.sortable({
            placeholder: 'highlight',
            items: '.js-ak-draggable',
            handle: '.js-ak-drag-me',
            forceHelperSize: true,
            forcePlaceholderSize: true,
            opacity: .8,
            tolerance: 'pointer',
            grid: [1, 1],
            create: function (e, ui) {
                $(this).find('>*').each(function (index) {
                    let org_w = $(this).width();
                    let org_h = $(this).height();
                    $(this).width(org_w)
                    $(this).height(org_h)
                });
            },
            stop: function (event, ui) {
                let data_array = [];
                let send_to = $(this).closest('.js-ak-content-layout').data('save-sort-url');
                $(this).find('.js-ak-drag-me').each(function () {
                    data_array.push($(this).data('id'));
                });
                if (send_to && data_array.length > 0) {
                    $.ajax({
                        url: send_to,
                        type: 'POST',
                        data: {action: 'save_order', "sort_num_order": data_array, "_token": csrf_token},
                        dataType: 'JSON',
                        success: function (data) {
                            if (data.success) {
                                ToastStart.success(data.message);
                            } else {
                                ToastStart.error(data.message);
                            }
                        },
                        error: function () {
                            ToastStart.error(server_side_error_message);
                        },
                    });
                } else {
                    ToastStart.error(server_side_error_message);
                }
            }
        });
        $(window).resize(function () {
            $(element).find('>*').width("").height("").each(function (index) {
                let org_w = $(this).width();
                let org_h = $(this).height();
                $(this).width(org_w);
                $(this).height(org_h);
            });
        });
    }
}
