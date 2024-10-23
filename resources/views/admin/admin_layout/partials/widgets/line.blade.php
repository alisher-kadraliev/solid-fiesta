<div class="widget-layout {{$widgetData['width']}}{{$widgetData['custom_class']}} js-ak-widget-line{{$widgetData['disable_js']}}" id="{{$widgetData['id']}}"
     data-route="{{route($widgetData['route'])}}"
     data-decimals="{{$widgetData['decimals']}}"
     data-prefix="{{$widgetData['prefix']}}"
     data-suffix="{{$widgetData['suffix']}}"
>
    <div class="widget-content widget-line js-ak-widget-content">
        @if($widgetData['date_picker'] === "on")
            @includeIf("admin/admin_layout/partials/widgets/partials/date_picker")
        @endif
        <div>
            <h3>{{$widgetData['title']}}</h3>
        </div>
        <div class="render-chart js-ak-render-chart">
        </div>
    </div>
</div>
