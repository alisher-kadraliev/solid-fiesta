/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class FormValidateBase {
    constructor() {
        this.init();
    }
    init() {
        let self = this;
        $('form.validate-form').on('submit', function (event) {
            let form = $(this);
            self.disableButton(form);
            self.validateFields(form);
            if (self.validateCheckBox(form) === false || form[0].checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                self.enableButton(form);
                let firstVisibleError = $('.error-message:visible').first();
                if (firstVisibleError.length) {
                    firstVisibleError.closest('.input-container')[0].scrollIntoView({behavior: 'smooth'});
                }
            }
            form.addClass('validated');
        });
    }

    validateFields(form) {
        this.validateFiles(form);
    }

    enableButton(form) {
        form.find('.submit-button').attr("disabled", false)
    }

    disableButton(form) {
        form.find('.submit-button').attr("disabled", true);
    }

    validateCheckBox(form) {
        let isValid = true;
        $(form).find(".js-ak-checkbox-required").each(function (e) {
            $(this).find(".error-message").hide();
            if ($(this).find(':checkbox:checked').length === 0) {
                isValid = false;
                $(this).find(".error-message").show();
            }
        })
        return isValid;
    }
    validateFiles() {
        $(".js-ak-file-upload,.js-ak-image-upload,.js-ak-image-cropper-upload").each(function (e) {
            let requiredCheck = true;
            let typeCheck = true;
            let sizeCheck = true;
            let fileName = $(this).val();
            let idName = $(this).data('id');
            let errorText = '';

            if ($(this).prop('required') && fileName === '' && $('.js-ak-' + idName + '-available').length === 0) {
                requiredCheck = false;
                errorText = $(this).siblings(".error-message").data('required');
            }
            if (typeof $(this).data('file-type') !== 'undefined' && this.files[0]) {

                var extension = '.' + fileName.split('.').pop();
                if ($(this).data('file-type').split(",").indexOf(extension) < 0) {
                    typeCheck = false;
                    errorText = errorText + ' ' + $(this).siblings(".error-message").data('type');
                }
            }

            if (typeof $(this).data('file-max-size') !== 'undefined' && this.files[0]) {
                var fileSize = this.files[0].size / 1048576;
                if (fileSize > $(this).data('file-max-size')) {
                    sizeCheck = false;
                    errorText = errorText + ' ' + $(this).siblings(".error-message").data('size');
                }
            }
            if (requiredCheck === true && typeCheck === true && sizeCheck === true) {
                $(this)[0].setCustomValidity('');
            } else {
                $(this).siblings(".error-message").text(errorText);
                errorText = errorText + ' ' + $(this).siblings(".error-message").data('size-type');
                $(this)[0].setCustomValidity(errorText);
            }
        })
    }
}
