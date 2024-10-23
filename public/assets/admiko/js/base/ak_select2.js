/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkSelect2 {
    constructor() {
        this.Select2Start();
        this.Select2StartMany();
        this.Select2StartManySort();
    }

    Select2Start() {
        let self = this;
        $(".js-ak-select2").each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                let ajax = self.Select2Ajax($(this));
                $(this).select2({
                    dropdownCssClass: 'ak-select2-dropdown',
                    selectionCssClass: 'ak-select2-selected',
                    ajax: ajax,
                }).on("select2:clear", function (e) {
                    //on clear prevent opening
                    $(this).on("select2:opening.cancelOpen", function (e) {
                        e.preventDefault();
                        $(this).off("select2:opening.cancelOpen");
                    });
                })
            }
        })
    }

    Select2StartMany() {
        let self = this;
        $(".js-ak-select2-many").each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                let ajax = self.Select2Ajax($(this));
                $(this).select2({
                    dropdownCssClass: 'ak-select2-dropdown',
                    selectionCssClass: 'ak-select2-selected',
                    closeOnSelect: true,
                    ajax: ajax,
                }).on("select2:clear, select2:unselect", function (e) {
                    //on clear prevent opening
                    $(this).on("select2:opening.cancelOpen", function (e) {
                        e.preventDefault();
                        $(this).off("select2:opening.cancelOpen");
                    });
                })
            }
        })
    }

    Select2StartManySort() {
        let self = this;
        $(".js-ak-select2-many-sort").each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                let ajax = self.Select2Ajax($(this));
                let selElement = $(this);
                selElement.find('select').each(function () {
                    $(this).html($(this).find("option").sort(function (a, b) {
                        return Number(a.dataset.order) == Number(b.dataset.order) ? 0 : Number(a.dataset.order) < Number(b.dataset.order) ? -1 : 1
                    }))
                })
                selElement.find('select').select2({
                    dropdownCssClass: 'ak-select2-dropdown',
                    selectionCssClass: 'ak-select2-selected',
                    closeOnSelect: true,
                    ajax: ajax,
                    templateSelection: function (value) {
                        if (!value.id) return value.text;
                        return value.text + ' <span><svg height="14px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M278.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-64 64c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8h32v96H128V192c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V288h96v96H192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l64 64c12.5 12.5 32.8 12.5 45.3 0l64-64c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8H288V288h96v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6v32H288V128h32c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-64-64z"/></svg></span>';
                    },
                    escapeMarkup: function (m) {
                        return m;
                    }
                }).on("select2:select", function (evt) {
                    //add to the end
                    let element = $(evt.params.data.element);
                    element.detach();
                    $(this).append(element);
                    $(this).trigger("change");
                }).on("select2:clear, select2:unselect", function (e) {
                    //on clear prevent opening
                    $(this).on("select2:opening.cancelOpen", function (e) {
                        e.preventDefault();
                        $(this).off("select2:opening.cancelOpen");
                    });
                })
                $(this).find('.select2-selection__rendered').sortable({
                    items: 'li',
                    stop: function (event, ui) {
                        ui.item.parent().children('[title]').each(function () {
                            let title = $(this).attr('title');
                            let original = $('option:contains(' + title + ')', selElement.find("select")).first();
                            original.detach();
                            selElement.find("select").append(original)
                        });
                        selElement.find("select").change();
                    }
                });
            }
        })
    }

    Select2Ajax(element) {
        if(element.data('search-url')){
            return {
                url: element.data('search-url'),
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.text,
                                id: item.id
                            }
                        })
                    };
                },
                cache: false
            }
        } else {
            return null;
        }
    }
}
