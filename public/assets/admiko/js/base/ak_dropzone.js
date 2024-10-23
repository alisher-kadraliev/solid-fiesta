/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkDropZone {
    constructor() {
        this.startDropZone();
    }
    startDropZone() {
        $('.js-ak-content-layout').on('click', '.js-ak-dropzone-toggle', function (event) {
            event.preventDefault();
            let parent = $(this).closest(".js-ak-content-layout")
            parent.find('.js-ak-dropzone-container').slideToggle(300, function () {
                if (!$(this).find(".dz-clickable").length) {
                    let settings = $(this).data("settings");
                    let element = $(this).find(".dropzone");
                    new Dropzone(element[0], eval(settings));
                } else {
                    if ($(this).find(".dz-complete").length) {
                        $(this).find(".dz-complete").remove();
                        if ($(this).find(".dz-clickable").hasClass("dz-started")) {
                            $(this).find(".dz-clickable").removeClass('dz-started')
                        }
                    }
                }
            });
        })
    }
}
