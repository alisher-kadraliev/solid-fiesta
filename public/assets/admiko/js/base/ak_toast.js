/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkToast {
    constructor() {

    }
    closeToast(element) {
        element.closest(".js-ak-notification").remove()
    }
    success(message) {
        let element = $(".js-ak-template .js-ak-toast-success");
        element.find(".js-ak-toast-message").html(message);
        element.find(".js-ak-notification").clone().hide().appendTo(".js-ak-toasts").fadeIn(300).find(".js-ak-progress-bar").animate({
            width: "100%"
        }, 3000).closest(".js-ak-notification").delay(3000).fadeOut(400, function() {
            $(this).remove();
        })
    }

    error(message) {
        this.showToast($(".js-ak-template .js-ak-toast-error"), message)
    }

    alert(message) {
        this.showToast($(".js-ak-template .js-ak-toast-alert"), message)
    }

    showToast(element, message) {
        element.find(".js-ak-toast-message").html(message);
        element.find(".js-ak-notification").clone().hide().appendTo(".js-ak-toasts").fadeIn(300);
    }
}
