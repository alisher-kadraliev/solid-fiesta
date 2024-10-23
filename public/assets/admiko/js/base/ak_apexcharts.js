/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * Note: To avoid overwriting, it is recommended to extend this class inside /public/assets/admiko/js/custom/ folder.
 **/
class AkApexCharts {
    constructor() {
        this.ApexChartLoad();
    }

    ApexChartLoad() {
        this.CounterWidget();
        this.PieWidget();
        this.LineWidget();
        this.ProgressWidget();
        this.BarWidget();
        this.ColumnWidget();
        this.RadarWidget();
        this.RadialBarWidget();
        this.PolarWidget();
        this.AreaWidget();
        this.DonutWidget();
        this.WidgetCalendarStart();
    }

    WidgetCalendarStart() {
        $(".js-ak-widget-calendar-icon").on('click', function () {
            $(this).prev().click();
        })
        $('.js-ak-widget-calendar-date-picker').each(function () {
            $(this).flatpickr({
                mode: 'single',
                altInput: true,
                altFormat: flatPickerSettings.date_format,
                dateFormat: "Y-m-d",
                disableMobile: 1,
                locale: flatPickerSettings.locale
            });
        })
    }

    CounterWidget() {
        $(".js-ak-widget-counter").each(function () {
            let element = {
                container: $(this),
                start: function () {
                    this.ajax_update();
                    let self = this;
                    element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                        $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                    })
                    element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                        $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                    })
                    element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                        e.preventDefault()
                        let form_date = $(this).serializeArray();
                        self.ajax_update(form_date);
                        $(this).fadeOut(200);
                    })
                },
                ajax_update: function (form_data = "") {
                    let ajax_data = {};
                    $.each(form_data, function (i, field) {
                        ajax_data[field.name] = field.value;
                    });
                    ajax_data['action'] = 'ajax_get';
                    ajax_data['_token'] = csrf_token;
                    $.ajax({
                        url: element.container.data('route'),
                        type: 'POST',
                        data: ajax_data,
                        dataType: 'JSON',
                        success: function (data) {
                            element.container.find(".js-ak-widget-numbers span").html(data.counter);
                        },
                        error: function (data) {
                            ToastStart.error(server_side_error_message);
                        },
                    });
                }
            };
            element.start();
        })
    }


    ProgressWidget() {
        $(".js-ak-widget-progress").each(function () {
                if (!$(this).hasClass('js-ak-disable-js')) {
                    let renderElement = $(this).find(".js-ak-render-chart");
                    let prefix = $(this).data("prefix");
                    let suffix = $(this).data("suffix");
                    let decimals = $(this).data("decimals");
                    let options = {
                        chart: {
                            height: '95px',
                            width: '100%',
                            type: 'area',
                            sparkline: {
                                enabled: true,
                            },
                            toolbar: {
                                show: false,
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        title: {
                            text: undefined,
                        },
                        legend: {
                            show: false,
                        },
                        grid: {
                            show: false,
                            padding: {
                                top: 5
                            },
                        },
                        series: [{name: "", data: []}],
                        xaxis: {
                            categories: [],
                            labels: {
                                show: false
                            },
                        },
                        yaxis: {
                            labels: {
                                show: false,
                                formatter: function (val, index) {
                                    if (typeof val === 'number' && !isNaN(val)) {
                                        return prefix.toString() + val.toFixed(decimals).toString() + suffix.toString();
                                    }else if (!isNaN(val)) {
                                        return prefix.toString() + val.toString() + suffix.toString();
                                    } else {
                                        return prefix.toString() + '0' + suffix.toString();
                                    }
                                }
                            }
                        },
                        markers: {
                            size: 0,
                        },
                        tooltip: {
                            theme: "light",
                            fixed: {
                                enabled: true,
                                position: "topLeft",
                            },

                        },
                        noData: {
                            text: widget_lang.loading
                        }
                    };

                    let chart = new ApexCharts(renderElement[0], options)

                    let element = {
                        container: $(this),
                        chart: chart,
                        start: function () {
                            this.chart.render();
                            this.ajax_update();
                            let self = this;
                            element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                                $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                            })
                            element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                                $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                            })
                            element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                                e.preventDefault()
                                let form_date = $(this).serializeArray();
                                self.ajax_update(form_date);
                                $(this).fadeOut(200);
                            })
                        },
                        ajax_update: function (form_data = "") {
                            let ajax_data = {};
                            $.each(form_data, function (i, field) {
                                ajax_data[field.name] = field.value;
                            });
                            ajax_data['action'] = 'ajax_get';
                            ajax_data['_token'] = csrf_token;
                            $.ajax({
                                url: element.container.data('route'),
                                type: 'POST',
                                data: ajax_data,
                                dataType: 'JSON',
                                success: function (data) {
                                    if (Array.isArray(data.series) && data.series.length > 0) {
                                        element.chart.updateOptions({
                                            series: [{data: data.series}],
                                            xaxis: {categories: data.labels}
                                        });
                                    } else {
                                        element.chart.updateOptions({
                                            noData: {
                                                text: widget_lang.no_results
                                            }
                                        });
                                    }
                                    element.container.find(".js-ak-widget-numbers span").html(data.counter);
                                },
                                error: function (data) {
                                    ToastStart.error(server_side_error_message);
                                },
                            });
                        }
                    };
                    element.start();

                }
            }
        )
    }
    PieWidget() {
        $(".js-ak-widget-pie").each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                let renderElement = $(this).find(".js-ak-render-chart");
                let options = {
                    series: [],
                    labels: [],
                    chart: {
                        type: 'pie',
                        height: '330px',
                        width: '100%'
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                    },
                    title: {
                        text: undefined,
                    },
                    noData: {
                        text: widget_lang.loading
                    }
                }

                let chart = new ApexCharts(renderElement[0], options);

                let element = {
                    container: $(this),
                    chart: chart,
                    start: function () {
                        this.chart.render();
                        this.ajax_update();
                        let self = this;
                        element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                            $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                        })
                        element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                            $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                        })
                        element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                            e.preventDefault()
                            let form_date = $(this).serializeArray();
                            self.ajax_update(form_date);
                            $(this).fadeOut(200);
                        })
                    },
                    ajax_update: function (form_data = "") {
                        let ajax_data = {};
                        $.each(form_data, function (i, field) {
                            ajax_data[field.name] = field.value;
                        });
                        ajax_data['action'] = 'ajax_get';
                        ajax_data['_token'] = csrf_token;
                        $.ajax({
                            url: element.container.data('route'),
                            type: 'POST',
                            data: ajax_data,
                            dataType: 'JSON',
                            success: function (data) {
                                if (Array.isArray(data.series) && data.series.length > 0) {
                                    element.chart.updateOptions({
                                        series: data.series,
                                        labels: data.labels
                                    })
                                } else {
                                    element.chart.updateOptions({
                                        noData: {
                                            text: widget_lang.no_results
                                        }
                                    });
                                }
                            },
                            error: function (data) {
                                ToastStart.error(server_side_error_message);
                            },
                        });
                    }
                };
                element.start();
            }
        })
    }

    DonutWidget() {
        $(".js-ak-widget-donut").each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                let renderElement = $(this).find(".js-ak-render-chart");
                let options = {
                    series: [],
                    labels: [],
                    chart: {
                        type: 'donut',
                        height: '300px',
                        width: '100%'
                    },
                    plotOptions: {
                        pie: {
                            startAngle: -90,
                            endAngle: 90,
                        }
                    },
                    grid: {
                        padding: {
                            bottom: -180,
                            left:-30,
                            right:-30
                        }
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                    },
                    title: {
                        text: undefined,
                    },
                    noData: {
                        text: widget_lang.loading
                    }
                }

                let chart = new ApexCharts(renderElement[0], options);

                let element = {
                    container: $(this),
                    chart: chart,
                    start: function () {
                        this.chart.render();
                        this.ajax_update();
                        let self = this;
                        element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                            $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                        })
                        element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                            $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                        })
                        element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                            e.preventDefault()
                            let form_date = $(this).serializeArray();
                            self.ajax_update(form_date);
                            $(this).fadeOut(200);
                        })
                    },
                    ajax_update: function (form_data = "") {
                        let ajax_data = {};
                        $.each(form_data, function (i, field) {
                            ajax_data[field.name] = field.value;
                        });
                        ajax_data['action'] = 'ajax_get';
                        ajax_data['_token'] = csrf_token;
                        $.ajax({
                            url: element.container.data('route'),
                            type: 'POST',
                            data: ajax_data,
                            dataType: 'JSON',
                            success: function (data) {
                                if (Array.isArray(data.series) && data.series.length > 0) {
                                    element.chart.updateOptions({
                                        series: data.series,
                                        labels: data.labels
                                    })
                                } else {
                                    element.chart.updateOptions({
                                        noData: {
                                            text: widget_lang.no_results
                                        }
                                    });
                                }
                            },
                            error: function (data) {
                                ToastStart.error(server_side_error_message);
                            },
                        });
                    }
                };
                element.start();
            }
        })
    }
    PolarWidget() {
        $(".js-ak-widget-polar").each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                let renderElement = $(this).find(".js-ak-render-chart");
                // let prefix = $(this).data("prefix");
                // let suffix = $(this).data("suffix");
                // let decimals = $(this).data("decimals");
                let options = {
                    series: [],
                    labels: [],
                    chart: {
                        type: 'polarArea',
                        height: '330px',
                        width: '100%'
                    },
                    stroke: {
                        colors: ['#fff']
                    },
                    fill: {
                        opacity: 0.8
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                    },
                    title: {
                        text: undefined,
                    },
                    yaxis: {
                        labels: {
                            formatter: (val) => {
                                if (typeof val === 'number' && !isNaN(val)) {
                                    return val.toFixed(2);
                                }else if (!isNaN(val)) {
                                    return val.toString();
                                } else {
                                    return '0';
                                }
                            },
                        }
                    },
                    noData: {
                        text: widget_lang.loading
                    }
                }

                let chart = new ApexCharts(renderElement[0], options);

                let element = {
                    container: $(this),
                    chart: chart,
                    start: function () {
                        this.chart.render();
                        this.ajax_update();
                        let self = this;
                        element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                            $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                        })
                        element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                            $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                        })
                        element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                            e.preventDefault()
                            let form_date = $(this).serializeArray();
                            self.ajax_update(form_date);
                            $(this).fadeOut(200);
                        })
                    },
                    ajax_update: function (form_data = "") {
                        let ajax_data = {};
                        $.each(form_data, function (i, field) {
                            ajax_data[field.name] = field.value;
                        });
                        ajax_data['action'] = 'ajax_get';
                        ajax_data['_token'] = csrf_token;
                        $.ajax({
                            url: element.container.data('route'),
                            type: 'POST',
                            data: ajax_data,
                            dataType: 'JSON',
                            success: function (data) {
                                if (Array.isArray(data.series) && data.series.length > 0) {
                                    element.chart.updateOptions({
                                        series: data.series,
                                        labels: data.labels
                                    });
                                } else {
                                    element.chart.updateOptions({
                                        noData: {
                                            text: widget_lang.no_results
                                        }
                                    });
                                }
                            },
                            error: function (data) {
                                ToastStart.error(server_side_error_message);
                            },
                        });
                    }
                };
                element.start();
            }
        })
    }

    RadialBarWidget() {
        $(".js-ak-widget-radial-bar").each(function () {
            if (!$(this).hasClass('js-ak-disable-js')) {
                let renderElement = $(this).find(".js-ak-render-chart");
                let options = {
                    series: [],
                    labels: [],
                    chart: {
                        type: 'radialBar',
                        height: '330px',
                        width: '100%'
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                    },
                    title: {
                        text: undefined,
                    },
                    noData: {
                        text: widget_lang.loading
                    }
                }

                let chart = new ApexCharts(renderElement[0], options);

                let element = {
                    container: $(this),
                    chart: chart,
                    start: function () {
                        this.chart.render();
                        this.ajax_update();
                        let self = this;
                        element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                            $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                        })
                        element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                            $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                        })
                        element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                            e.preventDefault()
                            let form_date = $(this).serializeArray();
                            self.ajax_update(form_date);
                            $(this).fadeOut(200);
                        })
                    },
                    ajax_update: function (form_data = "") {
                        let ajax_data = {};
                        $.each(form_data, function (i, field) {
                            ajax_data[field.name] = field.value;
                        });
                        ajax_data['action'] = 'ajax_get';
                        ajax_data['_token'] = csrf_token;
                        $.ajax({
                            url: element.container.data('route'),
                            type: 'POST',
                            data: ajax_data,
                            dataType: 'JSON',
                            success: function (data) {
                                if (Array.isArray(data.series) && data.series.length > 0) {
                                    const sum = data.series.reduce((acc, num) => acc + num, 0);
                                    data.series = data.series.map(num => Math.round(num / sum * 100));
                                    element.chart.updateOptions({
                                        series: data.series,
                                        labels: data.labels,
                                        plotOptions: {
                                            radialBar: {
                                                dataLabels: {
                                                    total: {
                                                        show: true,
                                                        label: widget_lang.total,
                                                        formatter: function () {
                                                            return sum;
                                                        }
                                                    },
                                                    value: {
                                                        show: true,
                                                        formatter: function (val, opts) {
                                                            let perc = parseFloat(val).toFixed(2);
                                                            let origValue = (val / 100) * sum;
                                                            return perc + "%" + " (" + origValue.toFixed(1) + ")";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    })
                                } else {
                                    element.chart.updateOptions({
                                        noData: {
                                            text: widget_lang.no_results
                                        }
                                    });
                                }
                            },
                            error: function (data) {
                                ToastStart.error(server_side_error_message);
                            },
                        });
                    }
                };
                element.start();
            }
        })
    }



    LineWidget() {
        $(".js-ak-widget-line").each(function () {
                if (!$(this).hasClass('js-ak-disable-js')) {
                    let renderElement = $(this).find(".js-ak-render-chart");
                    let prefix = $(this).data("prefix");
                    let suffix = $(this).data("suffix");
                    let decimals = $(this).data("decimals");
                    let options = {
                        chart: {
                            height: '300px',
                            width: '100%',
                            type: 'line',
                            toolbar: {
                                show: false,
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        title: {
                            text: undefined,
                        },
                        legend: {
                            show: true,
                            position: 'top'
                        },
                        grid: {
                            show: true,
                            padding: {
                                top: 5
                            },
                        },
                        series: [{name: "", data: []}],
                        xaxis: {
                            categories: [],
                            labels: {
                                show: true,
                            }
                        },
                        yaxis: {
                            labels: {
                                show: true,
                                formatter: function (val, index) {
                                    if (typeof val === 'number' && !isNaN(val)) {
                                        return prefix.toString() + val.toFixed(decimals).toString() + suffix.toString();
                                    }else if (!isNaN(val)) {
                                        return prefix.toString() + val.toString() + suffix.toString();
                                    } else {
                                        return prefix.toString() + '0' + suffix.toString();
                                    }
                                }
                            }
                        },
                        markers: {
                            size: 3,
                        },
                        tooltip: {
                            x: {
                                show: true,
                            },
                        },
                        noData: {
                            text: widget_lang.loading
                        }
                    };

                    let chart = new ApexCharts(renderElement[0], options)

                    let element = {
                        container: $(this),
                        chart: chart,
                        start: function () {
                            this.chart.render();
                            this.ajax_update();
                            let self = this;
                            element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                                $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                            })
                            element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                                $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                            })
                            element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                                e.preventDefault()
                                let form_date = $(this).serializeArray();
                                self.ajax_update(form_date);
                                $(this).fadeOut(200);
                            })
                        },
                        ajax_update: function (form_data = "") {
                            let ajax_data = {};
                            $.each(form_data, function (i, field) {
                                ajax_data[field.name] = field.value;
                            });
                            ajax_data['action'] = 'ajax_get';
                            ajax_data['_token'] = csrf_token;
                            $.ajax({
                                url: element.container.data('route'),
                                type: 'POST',
                                data: ajax_data,
                                dataType: 'JSON',
                                success: function (data) {
                                    if (Array.isArray(data.series) && data.series[0].data.length > 0) {
                                        element.chart.updateOptions({
                                            series: data.series,
                                            xaxis: {categories: data.labels}
                                        });
                                    } else {
                                        element.chart.updateOptions({
                                            noData: {
                                                text: widget_lang.no_results
                                            }
                                        });
                                    }
                                },
                                error: function (data) {
                                    ToastStart.error(server_side_error_message);
                                },
                            });
                        }
                    };
                    element.start();

                }
            }
        )
    }

    AreaWidget() {
        $(".js-ak-widget-area").each(function () {
                if (!$(this).hasClass('js-ak-disable-js')) {
                    let renderElement = $(this).find(".js-ak-render-chart");
                    let prefix = $(this).data("prefix");
                    let suffix = $(this).data("suffix");
                    let decimals = $(this).data("decimals");
                    let options = {
                        chart: {
                            height: '300px',
                            width: '100%',
                            type: 'area',
                            toolbar: {
                                show: false,
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 2,
                        },
                        title: {
                            text: undefined,
                        },
                        legend: {
                            show: true,
                            position: 'top'
                        },
                        grid: {
                            show: true,
                            padding: {
                                top: 5
                            },
                        },
                        series: [{name: "", data: []}],
                        xaxis: {
                            categories: [],
                            labels: {
                                show: true
                            }
                        },
                        yaxis: {
                            labels: {
                                show: true,
                                formatter: function (val, index) {
                                    if (typeof val === 'number' && !isNaN(val)) {
                                        return prefix.toString() + val.toFixed(decimals).toString() + suffix.toString();
                                    }else if (!isNaN(val)) {
                                        return prefix.toString() + val.toString() + suffix.toString();
                                    } else {
                                        return prefix.toString() + '0' + suffix.toString();
                                    }
                                }

                            }
                        },
                        markers: {
                            size: 3,
                        },
                        tooltip: {
                            x: {
                                show: true,
                            },
                        },
                        noData: {
                            text: widget_lang.loading
                        }
                    };

                    let chart = new ApexCharts(renderElement[0], options)

                    let element = {
                        container: $(this),
                        chart: chart,
                        start: function () {
                            this.chart.render();
                            this.ajax_update();
                            let self = this;
                            element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                                $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                            })
                            element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                                $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                            })
                            element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                                e.preventDefault()
                                let form_date = $(this).serializeArray();
                                self.ajax_update(form_date);
                                $(this).fadeOut(200);
                            })
                        },
                        ajax_update: function (form_data = "") {
                            let ajax_data = {};
                            $.each(form_data, function (i, field) {
                                ajax_data[field.name] = field.value;
                            });
                            ajax_data['action'] = 'ajax_get';
                            ajax_data['_token'] = csrf_token;
                            $.ajax({
                                url: element.container.data('route'),
                                type: 'POST',
                                data: ajax_data,
                                dataType: 'JSON',
                                success: function (data) {
                                    if (Array.isArray(data.series) && data.series[0].data.length > 0) {
                                        element.chart.updateOptions({
                                            series: data.series,
                                            xaxis: {categories: data.labels}
                                        });
                                    } else {
                                        element.chart.updateOptions({
                                            noData: {
                                                text: widget_lang.no_results
                                            }
                                        });
                                    }
                                },
                                error: function (data) {
                                    ToastStart.error(server_side_error_message);
                                },
                            });
                        }
                    };
                    element.start();

                }
            }
        )
    }

    BarWidget() {
        $(".js-ak-widget-bar").each(function () {
                if (!$(this).hasClass('js-ak-disable-js')) {
                    let renderElement = $(this).find(".js-ak-render-chart");
                    let prefix = $(this).data("prefix");
                    let suffix = $(this).data("suffix");
                    let decimals = $(this).data("decimals");
                    let stacked = $(this).data("stacked");
                    let stacked_type = $(this).data("stackedType");
                    let options = {
                        chart: {
                            height: '300px',
                            width: '100%',
                            type: 'bar',
                            stacked: stacked,
                            stackType: stacked_type,
                            toolbar: {
                                show: false,
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                dataLabels: {
                                    total: {
                                        enabled: true,
                                        formatter: function (val) {
                                            return val
                                        }
                                    }
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true
                        },
                        title: {
                            text: undefined,
                        },
                        legend: {
                            show: true,
                            position: 'top'
                        },
                        grid: {
                            show: true,
                            padding: {
                                top: 5
                            },
                        },
                        series: [{name: "", data: []}],
                        xaxis: {
                            categories: [],
                            labels: {
                                show: true,
                                formatter: function (val, index) {
                                    if (typeof val === 'number' && !isNaN(val)) {
                                        return prefix.toString() + val.toFixed(decimals).toString() + suffix.toString();
                                    }else if (!isNaN(val)) {
                                        return prefix.toString() + val.toString() + suffix.toString();
                                    } else {
                                        return prefix.toString() + '0' + suffix.toString();
                                    }
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                show: true
                            }
                        },
                        tooltip: {
                            x: {
                                show: true,
                            },
                        },
                        noData: {
                            text: widget_lang.loading
                        }
                    };

                    let chart = new ApexCharts(renderElement[0], options)

                    let element = {
                        container: $(this),
                        chart: chart,
                        start: function () {
                            this.chart.render();
                            this.ajax_update();
                            let self = this;
                            element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                                $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                            })
                            element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                                $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                            })
                            element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                                e.preventDefault()
                                let form_date = $(this).serializeArray();
                                self.ajax_update(form_date);
                                $(this).fadeOut(200);
                            })
                        },
                        ajax_update: function (form_data = "") {
                            let ajax_data = {};
                            $.each(form_data, function (i, field) {
                                ajax_data[field.name] = field.value;
                            });
                            ajax_data['action'] = 'ajax_get';
                            ajax_data['_token'] = csrf_token;
                            $.ajax({
                                url: element.container.data('route'),
                                type: 'POST',
                                data: ajax_data,
                                dataType: 'JSON',
                                success: function (data) {
                                    if (Array.isArray(data.series) && data.series[0].data.length > 0) {
                                        element.chart.updateOptions({
                                            series: data.series,
                                            xaxis: {categories: data.labels}
                                        });
                                    } else {
                                        element.chart.updateOptions({
                                            noData: {
                                                text: widget_lang.no_results
                                            }
                                        });
                                    }
                                },
                                error: function (data) {
                                    ToastStart.error(server_side_error_message);
                                },
                            });
                        }
                    };
                    element.start();

                }
            }
        )
    }

    ColumnWidget() {
        $(".js-ak-widget-column").each(function () {
                if (!$(this).hasClass('js-ak-disable-js')) {
                    let renderElement = $(this).find(".js-ak-render-chart");
                    let prefix = $(this).data("prefix");
                    let suffix = $(this).data("suffix");
                    let decimals = $(this).data("decimals");
                    let stacked = $(this).data("stacked");
                    let stacked_type = $(this).data("stackedType");
                    let options = {
                        chart: {
                            height: '300px',
                            width: '100%',
                            type: 'bar',
                            stacked: stacked,
                            stackType: stacked_type,
                            toolbar: {
                                show: false,
                            }
                        },
                        dataLabels: {
                            enabled: true
                        },
                        title: {
                            text: undefined,
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    total: {
                                        enabled: true,
                                        formatter: function (val) {
                                            return val
                                        }
                                    }
                                }
                            },
                        },
                        fill: {
                            opacity: 0.8
                        },
                        legend: {
                            show: true,
                            position: 'top'
                        },
                        grid: {
                            show: true,
                            padding: {
                                top: 5
                            },
                        },
                        series: [{name: "", data: []}],
                        xaxis: {
                            categories: [],
                            labels: {
                                show: true
                            }
                        },
                        yaxis: {
                            labels: {
                                show: true,
                                formatter: function (val, index) {
                                    if (typeof val === 'number' && !isNaN(val)) {
                                        return prefix.toString() + val.toFixed(decimals).toString() + suffix.toString();
                                    }else if (!isNaN(val)) {
                                        return prefix.toString() + val.toString() + suffix.toString();
                                    } else {
                                        return prefix.toString() + '0' + suffix.toString();
                                    }
                                }
                            }
                        },
                        tooltip: {
                            x: {
                                show: true,
                            },
                        },
                        noData: {
                            text: widget_lang.loading
                        }
                    };

                    let chart = new ApexCharts(renderElement[0], options)

                    let element = {
                        container: $(this),
                        chart: chart,
                        start: function () {
                            this.chart.render();
                            this.ajax_update();
                            let self = this;
                            element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                                $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                            })
                            element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                                $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                            })
                            element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                                e.preventDefault()
                                let form_date = $(this).serializeArray();
                                self.ajax_update(form_date);
                                $(this).fadeOut(200);
                            })
                        },
                        ajax_update: function (form_data = "") {
                            let ajax_data = {};
                            $.each(form_data, function (i, field) {
                                ajax_data[field.name] = field.value;
                            });
                            ajax_data['action'] = 'ajax_get';
                            ajax_data['_token'] = csrf_token;
                            $.ajax({
                                url: element.container.data('route'),
                                type: 'POST',
                                data: ajax_data,
                                dataType: 'JSON',
                                success: function (data) {
                                    if (Array.isArray(data.series) && data.series[0].data.length > 0) {
                                        element.chart.updateOptions({
                                            series: data.series,
                                            xaxis: {categories: data.labels}
                                        });
                                    } else {
                                        element.chart.updateOptions({
                                            noData: {
                                                text: widget_lang.no_results
                                            }
                                        });
                                    }
                                },
                                error: function (data) {
                                    ToastStart.error(server_side_error_message);
                                },
                            });
                        }
                    };
                    element.start();

                }
            }
        )
    }

    RadarWidget() {
        $(".js-ak-widget-radar").each(function () {
                if (!$(this).hasClass('js-ak-disable-js')) {
                    let renderElement = $(this).find(".js-ak-render-chart");
                    let prefix = $(this).data("prefix");
                    let suffix = $(this).data("suffix");
                    let decimals = $(this).data("decimals");
                    let options = {
                        chart: {
                            height: '300px',
                            width: '100%',
                            type: 'radar',
                            toolbar: {
                                show: false,
                            }
                        },
                        title: {
                            text: undefined,
                        },
                        legend: {
                            show: true,
                            position: 'bottom',
                        },
                        series: [{name: "", data: []}],
                        xaxis: {
                            categories: [],
                            labels: {
                                show: true
                            }
                        },
                        yaxis: {
                            labels: {
                                show: true,
                                formatter: function (val, index) {
                                    if (typeof val === 'number' && !isNaN(val)) {
                                        return prefix.toString() + val.toFixed(decimals).toString() + suffix.toString();
                                    }else if (!isNaN(val)) {
                                        return prefix.toString() + val.toString() + suffix.toString();
                                    } else {
                                        return prefix.toString() + '0' + suffix.toString();
                                    }
                                }
                            }
                        },
                        tooltip: {
                            x: {
                                show: true,
                            },
                        },
                        noData: {
                            text: widget_lang.loading
                        }
                    };

                    let chart = new ApexCharts(renderElement[0], options)

                    let element = {
                        container: $(this),
                        chart: chart,
                        start: function () {
                            this.chart.render();
                            this.ajax_update();
                            let self = this;
                            element.container.find(".js-ak-widget-calendar-icon").on('click', function (e) {
                                $(this).closest('.js-ak-widget-content').find('.js-ak-widget-date-picker').fadeIn(100);
                            })
                            element.container.find(".js-ak-widget-date-picker-close").on('click', function (e) {
                                $(this).closest('.js-ak-widget-date-picker').fadeOut(100);
                            })
                            element.container.find(".js-ak-widget-date-picker").on('submit', function (e) {
                                e.preventDefault()
                                let form_date = $(this).serializeArray();
                                self.ajax_update(form_date);
                                $(this).fadeOut(200);
                            })
                        },
                        ajax_update: function (form_data = "") {
                            let ajax_data = {};
                            $.each(form_data, function (i, field) {
                                ajax_data[field.name] = field.value;
                            });
                            ajax_data['action'] = 'ajax_get';
                            ajax_data['_token'] = csrf_token;
                            $.ajax({
                                url: element.container.data('route'),
                                type: 'POST',
                                data: ajax_data,
                                dataType: 'JSON',
                                success: function (data) {
                                    if (Array.isArray(data.series) && data.series[0].data.length > 0) {
                                        element.chart.updateOptions({
                                            series: data.series,
                                            xaxis: {categories: data.labels}
                                        });
                                    } else {
                                        element.chart.updateOptions({
                                            noData: {
                                                text: widget_lang.no_results
                                            }
                                        });
                                    }
                                },
                                error: function (data) {
                                    ToastStart.error(server_side_error_message);
                                },
                            });
                        }
                    };
                    element.start();

                }
            }
        )
    }
}
