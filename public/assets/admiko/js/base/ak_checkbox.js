/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkCheckbox {
    constructor() {
        this.CheckboxSort();
    }
    CheckboxSort() {
        $(".js-ak-checkbox-sort").each(function () {
            let selElement = $(this);
            selElement.each(function () {
                $(this).html($(this).find(".js-ak-checkbox-item").sort(function (a, b) {
                    return Number(a.dataset.order) == Number(b.dataset.order) ? 0 : Number(a.dataset.order) < Number(b.dataset.order) ? -1 : 1
                }))
            })
            selElement.sortable({
                handle: 'span',
                opacity: .8,
                items: '.js-ak-checkbox-item',
                tolerance: 'pointer',
                placeholder: 'highlight',
                grid: [1, 1],
                forcePlaceholderSize: true,
                stop: function (event, ui) {
                    $(this).find('.js-ak-checkbox-order').each(function (index) {
                        $(this).val(index);
                    })
                }
            });
        })
    }
}
