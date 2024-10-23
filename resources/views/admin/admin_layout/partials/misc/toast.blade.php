<div class="toast-container js-ak-toast-container">
    <div class="toasts js-ak-toasts"></div>
    <div class="template js-ak-template">
        <div class="js-ak-toast-success">
            <div class="notification js-ak-notification">
                <div>
                    <div class="toast toast-success">
                        @includeIf("admin/admin_layout/partials/misc/icons/success_icon")
                    </div>
                    <div class="toast-message js-ak-toast-message"></div>
                </div>
                <button type="button" class="toast-close js-ak-toast-close" onclick="ToastStart.closeToast($(this))">
                    @includeIf("admin/admin_layout/partials/misc/icons/reset_search_icon")
                </button>
                <div class="toast_progress">
                    <div class="progress-bar js-ak-progress-bar" style="width: 0%"></div>
                </div>
            </div>
        </div>
        <div class="js-ak-toast-error">
            <div class="notification js-ak-notification">
                <div>
                    <div class="toast toast-error">
                        @includeIf("admin/admin_layout/partials/misc/icons/error_icon")
                    </div>
                    <div class="toast-message js-ak-toast-message"></div>
                </div>
                <button type="button" class="toast-close js-ak-toast-close" onclick="ToastStart.closeToast($(this))">
                    @includeIf("admin/admin_layout/partials/misc/icons/reset_search_icon")
                </button>
            </div>
        </div>
        <div class="js-ak-toast-alert">
            <div class="notification js-ak-notification">
                <div>
                    <div class="toast toast-alert">
                        @includeIf("admin/admin_layout/partials/misc/icons/alert_icon")
                    </div>
                    <div class="toast-message js-ak-toast-message"></div>
                </div>
                <button type="button" class="toast-close js-ak-toast-close" onclick="ToastStart.closeToast($(this))">
                    @includeIf("admin/admin_layout/partials/misc/icons/reset_search_icon")
                </button>
            </div>
        </div>
    </div>
</div>
@if (Session::has('toast_success'))
    <script>
        ToastStart.success("{{Session::get('toast_success')}}");
    </script>
@endif
@if (Session::has('toast_error'))
    <script>
        ToastStart.error("{{Session::get('toast_error')}}");
    </script>
@endif
@if (Session::has('toast_alert'))
    <script>
        ToastStart.alert("{{Session::get('toast_alert')}}");
    </script>
@endif
