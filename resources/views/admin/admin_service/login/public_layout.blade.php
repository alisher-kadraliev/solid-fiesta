<!doctype html>
<html lang="{!!trans("admin/config/html.html_language_code")!!}" dir="{!!trans("admin/config/html.html_language_direction")!!}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/admiko/css/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/admiko/css/theme/'.config('admin.settings.default_template', 'admiko').'/theme.css') }}">
    <title>Login</title>
</head>
<body>
<div class="public-container">
    <div class="public-content">
        @yield('content')
    </div>
</div>
<script src="{{ asset('assets/admiko/vendors/jquery/jquery.min.js') }}"></script>
<script>
    $('form.validate-form').on('submit', function (event) {
        let form = $(this);
        disableButton(form);
        if (form[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            enableButton(form);
        }
        form.addClass('validated');
    });

    function enableButton(form) {
        form.find('.js-ak-submit-button').attr("disabled", false)
    }

    function disableButton(form) {
        form.find('.js-ak-submit-button').attr("disabled", true);
    }
</script>
</body>
</html>
