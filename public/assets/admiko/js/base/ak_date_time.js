/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkDateTime {
    constructor() {
        this.DateCalendarStart();
        this.DateTimeCalendarStart();
        this.DateRangeCalendarStart();
        this.TimePickerStart();
    }
    DateCalendarStart() {
        $(".js-ak-calendar-icon").on('click', function () {
            $(this).prev().click();
        })
        let self = this;
        let showMonths = flatPickerSettings.locale.show_months;
        let defaultDate = null;
        $('.js-ak-date-picker').each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                if ($(this).data("showMonths")) {
                    showMonths = $(this).data("showMonths");
                }
                if ($(this).prop('required') && $(this).val() === "") {
                    defaultDate = new Date();
                }
                self.DateCalendarInit(
                    {
                        element: $(this),
                        mode: 'single',
                        locale: flatPickerSettings.locale,
                        altFormat: flatPickerSettings.date_format,
                        saveFormat: "Y-m-d",
                        enableTime: false,
                        noCalendar: false,
                        showMonths: showMonths,
                        enableSeconds: false,
                        defaultDate: defaultDate,
                    });
            }
        })
    }
    DateTimeCalendarStart() {
        $(".js-ak-calendar-icon").on('click', function () {
            $(this).prev().click();
        })
        let self = this;
        let showMonths = flatPickerSettings.locale.show_months;
        let enableSeconds = flatPickerSettings.locale.enable_seconds;
        let defaultDate = null;

        $('.js-ak-date-time-picker').each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                if ($(this).data("showMonths")) {
                    showMonths = $(this).data("showMonths");
                }
                if ($(this).data("enableSeconds")) {
                    enableSeconds = $(this).data("enableSeconds");
                }
                if ($(this).prop('required') && $(this).val() === "") {
                    defaultDate = new Date();
                }
                self.DateCalendarInit(
                    {
                        element: $(this),
                        mode: 'single',
                        locale: flatPickerSettings.locale,
                        altFormat: flatPickerSettings.date_time_format,
                        saveFormat: "Y-m-d H:i:S",
                        enableTime: true,
                        noCalendar: false,
                        showMonths: showMonths,
                        enableSeconds: enableSeconds,
                        defaultDate: defaultDate,
                    });
            }
        })
    }

    TimePickerStart() {
        $(".js-ak-time-icon").on('click', function () {
            $(this).prev().click();
        })
        let self = this;
        let enableSeconds = flatPickerSettings.locale.enable_seconds;
        let defaultDate = null;
        $('.js-ak-time-picker').each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                if ($(this).prop('required') && $(this).val() === "") {
                    defaultDate = new Date();
                }
                if ($(this).data("enableSeconds")) {
                    enableSeconds = $(this).data("enableSeconds");
                }
                self.DateCalendarInit(
                    {
                        element: $(this),
                        mode: 'single',
                        locale: flatPickerSettings.locale,
                        altFormat: flatPickerSettings.time_format,
                        saveFormat: "H:i:S",
                        enableTime: true,
                        noCalendar: true,
                        enableSeconds: enableSeconds,
                        defaultDate: defaultDate,
                    });
            }
        })
    }

    DateCalendarInit(data) {
        data.element.flatpickr({
            mode: data.mode,
            altInput: true,
            defaultDate: data.defaultDate,
            altFormat: data.altFormat,
            dateFormat: data.saveFormat,
            altInputClass: "form-input",
            enableTime: data.enableTime,
            enableSeconds: data.enableSeconds,
            noCalendar: data.noCalendar,
            showMonths: data.showMonths,
            disableMobile: 1,
            locale: data.locale
        });
    }
    DateRangeCalendarStart() {
        $(".js-ak-calendar-icon").on('click', function () {
            $(this).prev().click();
        })
        let self = this;
        let showMonths = flatPickerSettings.locale.show_months;
        let defaultDate = null;
        let defaultStartDate = null;
        let defaultEndDate = null;
        $('.js-ak-date-range-picker').each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                let disableDaysArray = eval($(this).data("startField") + '_' + $(this).data("endField") + '_disable_days');
                if ($(this).data("showMonths")) {
                    showMonths = $(this).data("showMonths");
                }
                if ($(this).prop('required') && $(this).val() === flatPickerSettings.rangeSeparator) {
                    defaultStartDate = new Date();
                    defaultEndDate = new Date();
                    defaultEndDate = defaultEndDate.setDate(defaultEndDate.getDate() + 1);
                    defaultDate = [defaultStartDate,defaultEndDate];
                }
                self.DateRangeCalendarInit(
                    {
                        element: $(this),
                        mode: 'range',
                        startField: "#" + $(this).data("startField"),
                        endField: "#" + $(this).data("endField"),
                        locale: flatPickerSettings.locale,
                        altFormat: flatPickerSettings.date_format,
                        saveFormat: "Y-m-d",
                        enableTime: false,
                        noCalendar: false,
                        showMonths: showMonths,
                        enableSeconds: false,
                        defaultDate: defaultDate,
                        disableDates: disableDaysArray,
                    });
            }
        })
    }

    DateRangeCalendarInit(data) {
        data.element.flatpickr({
            mode: data.mode,
            altInput: true,
            defaultDate: data.defaultDate,
            altFormat: data.altFormat,
            dateFormat: data.saveFormat,
            altInputClass: "form-input",
            enableTime: data.enableTime,
            enableSeconds: data.enableSeconds,
            noCalendar: data.noCalendar,
            showMonths: data.showMonths,
            disableMobile: 1,
            locale: data.locale,
            disable: data.disableDates,
            onChange: function(selectedDates, dateStr, instance) {
                const dateRange = dateStr.split(flatPickerSettings.rangeSeparator);
                if (dateRange.length === 2) {
                    $(data.startField+'_input').val(dateRange[0])
                    $(data.endField+'_input').val(dateRange[1])
                } else if (dateRange.length === 1) {
                    $(data.startField+'_input').val(dateRange[0])
                    $(data.endField+'_input').val(dateRange[0])
                }
            },
            onReady: function(selectedDates, dateStr, instance) {
                const dateRange = dateStr.split(flatPickerSettings.rangeSeparator);
                if (dateRange.length === 2) {
                    $(data.startField+'_input').val(dateRange[0])
                    $(data.endField+'_input').val(dateRange[1])
                } else if (dateRange.length === 1) {
                    $(data.startField+'_input').val(dateRange[0])
                    $(data.endField+'_input').val(dateRange[0])
                }
            },
        });
    }
}

