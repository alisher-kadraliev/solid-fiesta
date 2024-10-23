<div class="widget-layout {{$widgetData['width']}}{{$widgetData['custom_class']}} js-ak-widget-counter" id="{{$widgetData['id']}}" data-route="{{route($widgetData['route'])}}">
    <div class="widget-content widget-counter js-ak-widget-content">
        @if($widgetData['date_picker'] === "on")
            @includeIf("admin/admin_layout/partials/widgets/partials/date_picker")
        @endif
        <h3>{{$widgetData['title']}}</h3>
        <div class="widget-numbers js-ak-widget-numbers">
            {{$widgetData['prefix']}}<span></span>{{$widgetData['suffix']}}
        </div>
    </div>
</div>
