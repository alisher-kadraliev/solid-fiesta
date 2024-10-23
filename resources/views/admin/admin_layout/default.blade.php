<!doctype html>
<html lang="{!!trans("admin/config/html.html_language_code")!!}" dir="{!!trans("admin/config/html.html_language_direction")!!}">
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/admiko/css/images/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @includeIf('admin.admin_layout.scripts.header.scripts')
</head>
<body>
<div class="layout-container">
    <div class="sidebar-container">
        <nav class="sidebar">
            <div class="logo">
                <a href="{{route("admin.home")}}" draggable="false">
                    {{config('admin.logo.title')}}
                    <span class="subtitle">{{config('admin.logo.subtitle')}}</span>
                </a>
            </div>
            @includeIf('admin.admin_layout.partials.misc.avatar')
            <div class="menu-list">
                @includeIf('admin.admin_menu.include_menu')
            </div>
        </nav>
        @includeIf('admin.admin_layout.partials.layout.sidebar_footer')
    </div>
    <div class="page-container">
        @includeIf('admin.admin_layout.partials.layout.page_top_bar')
        <header class="page-header">
            @includeIf('admin.admin_layout.partials.layout.breadcrumbs')
            <div class="page-info">
                <h2>@yield('page-title')</h2>
                @hasSection('page-info')
                    <div class="info">@yield('page-info')</div>
                @endif
            </div>
            @hasSection('page-back-button')
                @includeIf('admin.admin_layout.partials.layout.page_back_button')
            @endif
        </header>
        <section class="page-section">
            <div class="page-content js-ak-page-content">
                @yield('page-content')
            </div>
        </section>
    </div>
</div>
@includeIf('admin.admin_layout.scripts.footer.scripts')
@includeIf("admin.admin_layout.partials.misc.toast")
</body>
</html>
