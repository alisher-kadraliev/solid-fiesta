/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkRange {
    constructor() {
        this.RangeStart();
    }
    RangeStart() {
        if ($('.js-ak-range').length > 0) {
            $(".js-ak-range").on("input mouseover mouseout", function (event) {
                if (!$(this).hasClass('js-ak-disable-js')) {
                    let toolTip = $(this).siblings(".js-ak-range-tooltip");
                    let value = $(this).val();
                    if (event.originalEvent.type === "mouseout") {
                        toolTip.html(value);
                        toolTip.css('visibility', 'hidden');
                    } else {
                        toolTip.html(value);
                        toolTip.css('visibility', 'visible');
                    }
                }
            });
        }
    }
}
