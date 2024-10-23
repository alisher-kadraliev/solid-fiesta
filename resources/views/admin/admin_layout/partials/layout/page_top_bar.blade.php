<div class="page-top-bar">
    <div class="left-side">
        <div class="icon-container js-ak-sidebar-toggle">
            <div class="icon">
                <div class="font-awesome-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="right-side">
        @if(!config('admin.settings.disable_import_page') && (auth()->user()->id == 1 || auth()->user()->rolesMany->contains('id',1)))
            <a class="icon-container import-page" draggable="false" href="{{route("admin.ak_admin_import")}}">
                <div class="icon">
                    <div class="font-awesome-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 640 512" stroke="currentColor">
                            <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-167l80 80c9.4 9.4 24.6 9.4 33.9 0l80-80c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-39 39V184c0-13.3-10.7-24-24-24s-24 10.7-24 24V318.1l-39-39c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9z"/>
                        </svg>
                    </div>
                </div>
            </a>
        @endif
        @include('admin.admin_layout.partials.misc.avatar')
    </div>
</div>
