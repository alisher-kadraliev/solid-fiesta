/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkGlobal {
    constructor() {
        this.sidebarToggle();
        this.dropDownToggle();
        this.updateTableLength();
        this.resetSearch();
        this.base64ImagePreview();
        this.modalClose();
    }

    sidebarToggle() {
        $('.js-ak-sidebar-toggle').on('click', function () {
            $('.sidebar-container').toggleClass('toggled');
        })
    }

    dropDownToggle() {
        $(".js-ak-dropdown .js-ak-dropdown-item").on("click", function (e) {
            e.preventDefault();
            let el = $(this).closest(".dropdown");
            if (el.hasClass("open")) {
                el.removeClass("open").find(".dropdown-container").slideUp();
            } else {
                $(".dropdown.open").removeClass("open").find(".dropdown-container").slideUp();
                el.addClass("open").find(".dropdown-container").slideDown();
            }
        });
    }

    updateTableLength() {
        $('.js-ak-content-layout').on('change', '.js-ak-table-length', function () {
            window.location = $(this).val();
            return false;
        });
    }

    resetSearch() {
        $('.js-ak-content-layout').on('click', '.js-ak-reset-search', function (event) {
            event.preventDefault();
            $(this).closest("form").find('.js-ak-search-input').val("");
            $(this).closest("form").submit();
        })
    }

    base64ImagePreview() {
        $('.js-ak-page-content').on('click', '.js-base64-image-preview', function (event) {
            event.preventDefault();
            let newTab = window.open();
            newTab.document.body.innerHTML = '<img src="' + $(this).attr('href') + '"/>';
        })
    }
    modalClose() {
        $('.js-ak-page-content').on('click', '.js-ak-modal-close', function (event) {
            event.preventDefault();
            $(this).closest(".js-ak-modal").fadeOut(100);
        })
    }

}
