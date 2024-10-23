<div class="widget-layout {{$widgetData['width']}}{{$widgetData['custom_class']}} js-ak-widget-donut{{$widgetData['disable_js']}}" id="{{$widgetData['id']}}" data-route="{{route($widgetData['route'])}}">
    <div class="widget-content widget-donut js-ak-widget-content">
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
