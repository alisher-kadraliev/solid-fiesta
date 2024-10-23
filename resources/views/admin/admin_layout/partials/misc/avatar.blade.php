<div class="sidebar-user">
    <div class="sidebar-user-image">
        <img src="{{auth()->user()->image}}" draggable="false">
    </div>
    <div class="sidebar-user-info">
        <div class="sidebar-user-name">{{auth()->user()->name}}</div>
        <div class="sidebar-user-email">{{auth()->user()->email}}</div>
    </div>
    <div class="sidebar-user-links">
        <a draggable="false" class="link" href="{{route("admin.my_account")}}">
            <div class="icon">
                <div class="font-awesome-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M224 256c70.7 0 128-57.31 128-128s-57.3-128-128-128C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3c0 19.14 15.52 34.67 34.66 34.67h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304z"/>
                    </svg>
                </div>
            </div>
            <div class="title">{{ trans('admin/misc.my_account') }}</div>
        </a>
        <a draggable="false" class="link" href="{{route("admin.logout")}}">
            <div class="icon">
                <div class="font-awesome-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M288 256C288 273.7 273.7 288 256 288C238.3 288 224 273.7 224 256V32C224 14.33 238.3 0 256 0C273.7 0 288 14.33 288 32V256zM80 256C80 353.2 158.8 432 256 432C353.2 432 432 353.2 432 256C432 201.6 407.3 152.9 368.5 120.6C354.9 109.3 353 89.13 364.3 75.54C375.6 61.95 395.8 60.1 409.4 71.4C462.2 115.4 496 181.8 496 255.1C496 388.5 388.5 496 256 496C123.5 496 16 388.5 16 255.1C16 181.8 49.75 115.4 102.6 71.4C116.2 60.1 136.4 61.95 147.7 75.54C158.1 89.13 157.1 109.3 143.5 120.6C104.7 152.9 80 201.6 80 256z"/>
                    </svg>
                </div>
            </div>
            <div class="title">{{ trans('admin/misc.logout') }}</div>
        </a>
    </div>
</div>
