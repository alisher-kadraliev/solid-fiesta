<div class="widget-date-picker-icon">
    <div class="widget-calendar-icon js-ak-widget-calendar-icon">
        @includeIf("admin/admin_layout/partials/misc/icons/calendar_icon")
    </div>
</div>
<form class="widget-date-picker js-ak-widget-date-picker" style="display: none">
    <div class="widget-date-picker-close js-ak-widget-date-picker-close">
        <div class="icon">
            <div class="font-awesome-icon">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                    <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"/>
                </svg>
            </div>
        </div>
    </div>
    <div class="widget-date-input">
        <input type="text" name="date_start" autocomplete="off"
               class="js-ak-widget-calendar-date-picker"
               placeholder="{{trans('admin/misc.widgets_date_start')}}"
               value="{{$widgetData['date_start']??""}}">
        <div class="input-suffix js-ak-widget-calendar-icon">
            @includeIf("admin/admin_layout/partials/misc/icons/calendar_icon")
        </div>
    </div>
    <div class="widget-date-input">
        <input type="text" name="date_end" autocomplete="off"
               class="js-ak-widget-calendar-date-picker"
               placeholder="{{trans('admin/misc.widgets_date_end')}}"
               value="{{$widgetData['date_end']??""}}">
        <div class="input-suffix js-ak-widget-calendar-icon">
            @includeIf("admin/admin_layout/partials/misc/icons/calendar_icon")
        </div>
    </div>
    <div>
        <button class="button primary-button" draggable="false">
            <div class="icon">
                <div class="font-awesome-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z"/>
                    </svg>
                </div>
            </div>
            {{trans('admin/misc.widgets_search')}}</button>
    </div>
</form>
