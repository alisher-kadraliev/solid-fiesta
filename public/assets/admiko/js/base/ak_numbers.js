/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkNumbers {
    constructor() {
        this.NumbersStart();
    }
    NumbersStart() {
        let self = this;
        $(".js-ak-limit-poz-neg-numbers").on("keypress input blur paste", function (event) {
            if (!$(this).hasClass('js-ak-disable-js')) {
                if (event.originalEvent.type === "keypress") {
                    return self.fixIntegerNumber(this, "keyCheck", event);
                } else {
                    let number = self.fixIntegerNumber($(this), "valCheck", event);
                    number = self.checkMinMax(number, $(this).attr('min'), $(this).attr('max'));
                    $(this).val(number);
                }
            }
        });

        $(".js-ak-limit-poz-neg-dec-numbers").on("keypress input blur paste", function (event) {
            if (!$(this).hasClass('js-ak-disable-js')) {
                if (event.originalEvent.type === "keypress") {
                    return self.fixFloatNumber(this, "keyCheck", event);
                } else {
                    let number = self.fixFloatNumber($(this), "valCheck", event);
                    number = self.checkMinMax(number, $(this).attr('min'), $(this).attr('max'));
                    $(this).val(number);
                }
            }
        });
    }

    fixIntegerNumber(element, action, event) {
        let returnInput = $(element).val(),
            caretStart = event.target.selectionStart,
            caretEnd = event.target.selectionEnd,
            negative = "",
            validateNumbers = new RegExp(/^[0-9]*$/),
            checkMinus = new RegExp(/-/);
        if (returnInput.indexOf("-") === 0) {
            negative = "-";
            returnInput = returnInput.slice(1);
        }
        if (action === 'keyCheck') {
            if (checkMinus.test(returnInput) || (returnInput.length && event.key === "-" && caretStart > 0)) return false;
            if (returnInput === "0" && event.key === "-") return true;
            if (returnInput.indexOf("-") === 0 && event.key === "-" && caretStart === 0 && caretEnd === 0) return false;
            if (returnInput === "-" && caretStart === 0) return false;
            if (returnInput === "-" && event.key === "0") return false;
            if (returnInput.indexOf("-") === 0 && caretStart === 1 && event.key === "0") return false;
            if (returnInput === "0" && event.key === "0") return false;
            if (returnInput !== "" && event.key === "0" && caretStart === 0 && caretEnd === 0) return false;
            if (returnInput === "" && event.key === "-") return true;
            if (returnInput !== "" && event.key === "-" && caretStart === 0) return true;
            if (validateNumbers.test(event.key)) return true;
        } else if (action === 'valCheck') {
            returnInput = returnInput.replace(/[^0-9-]/g, '');
            if (this.isValidNumber(returnInput)) {
                returnInput = negative + '' + returnInput;
            } else if (returnInput === "") {
                returnInput = negative + '' + returnInput;
            } else {
                returnInput = negative + '' + returnInput.replace(/[^0-9]/g, '');
            }
            return returnInput;
        }
    }

    fixFloatNumber(element, action, event) {
        let returnInput = $(element).val(),
            caretStart = event.target.selectionStart,
            caretEnd = event.target.selectionEnd,
            negative = "",
            validateNumbers = new RegExp(/^[0-9.]*$/),
            checkMinus = new RegExp(/-/);
        if (returnInput.indexOf("-") === 0) {
            negative = "-";
            returnInput = returnInput.slice(1);
        }
        if (action === 'keyCheck') {
            if (checkMinus.test(returnInput)) return false;

            if ($(element).val() !== "" && event.key === "-" && caretStart > 0) return false;
            if ($(element).val() === "0" && event.key === "-") return true;
            if ($(element).val().indexOf("-") === 0 && event.key === "-" && caretStart === 0 && caretEnd === 0) return false;
            if ($(element).val() === "-" && caretStart === 0) return false;
            if ($(element).val() === "0" && event.key === "0") return false;
            if ($(element).val() !== "" && event.key === "0" && caretStart === 0 && caretEnd === 0) return false;
            if ($(element).val() === "" && event.key === "." && caretStart === 0) return false;
            if ($(element).val() !== "" && event.key === "." && caretStart === 0) return false;
            if ($(element).val().indexOf("-") === 0 && event.key === "." && caretStart === 1) return false;
            if ($(element).val().indexOf(".") > -1 && event.key === ".") return false;

            if (typeof $(element).data('decimal') !== 'undefined') {
                let total_decimals = returnInput.substring(returnInput.indexOf(".") + 1, returnInput.length).length;
                if (caretStart > returnInput.indexOf(".") && returnInput.indexOf('.') > 0 && total_decimals >= $(element).data('decimal')) {
                    return false;
                }
            }
            if ($(element).val() === "" && event.key === "-") return true;
            if ($(element).val() !== "" && event.key === "-" && caretStart === 0) return true;
            if (validateNumbers.test(event.key)) return true;

        } else if (action === 'valCheck') {
            returnInput = returnInput.replace(/[^0-9-.]/g, '');
            if (this.isValidNumber(returnInput)) {
                if ($(element).val().indexOf(".") > -1 && $(element).val().indexOf(".") === $(element).val().length) {
                    returnInput = negative + '' + parseFloat(returnInput);
                } else {
                    returnInput = negative + '' + returnInput;
                }

            } else if (returnInput === "") {
                returnInput = negative + '' + returnInput;
            } else {
                returnInput = negative + '' + returnInput.replace(/[^0-9.]/g, '');
            }
            return returnInput;
        }
    }

    isValidNumber(number) {
        return !isNaN(number) && !isNaN(parseFloat(number));
    }

    checkMinMax(number, min, max) {
        max = parseFloat(max);
        if (this.isValidNumber(max) && this.isValidNumber(number)) {
            if (max < parseFloat(number)) {
                number = max;
            }
        }
        min = parseFloat(min);
        if (this.isValidNumber(min) && this.isValidNumber(number)) {
            if (min > parseFloat(number)) {
                number = min;
            }
        }
        return number;
    }

}
