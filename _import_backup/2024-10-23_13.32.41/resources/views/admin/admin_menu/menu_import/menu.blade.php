{{--IMPORTANT: Any modifications made to this file will be lost during updates.!!! --}}

<div class="item{{ $menu['item'] === "home" ? " active" : "" }}">
	<a draggable="false" class="link" href="{{route("admin.home")}}">
		<div class="icon">
			<div class="font-awesome-icon">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M0 192C0 103.6 71.6 32 160 32s160 71.6 160 160V320c0 88.4-71.6 160-160 160S0 408.4 0 320V192zM160 96c-53 0-96 43-96 96V320c0 53 43 96 96 96s96-43 96-96V192c0-53-43-96-96-96z"/></svg>
			</div>
		</div>
		<div class="title">Home</div>
	</a>
</div>
@canany(['fixed_content_access'])
	<div class="item{{ $menu['item'] === "fixed_content" ? " active" : "" }}">
		<a draggable="false" class="link" href="{{route("admin.fixed_content.index")}}">
			<div class="icon">
				<div class="font-awesome-icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16H224v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm56 256c-13.3 0-24 10.7-24 24s10.7 24 24 24H264c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24H264c13.3 0 24-10.7 24-24s-10.7-24-24-24H120z"/></svg>
				</div>
			</div>
			<div class="title">Sabit içerik yönetimi</div>
		</a>
	</div>
@endcanany
@canany(['home_slider_access'])
	<div class="item{{ $menu['item'] === "home_slider" ? " active" : "" }}">
		<a draggable="false" class="link" href="{{route("admin.home_slider.index")}}">
			<div class="icon">
				<div class="font-awesome-icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16H224v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm56 256c-13.3 0-24 10.7-24 24s10.7 24 24 24H264c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24H264c13.3 0 24-10.7 24-24s-10.7-24-24-24H120z"/></svg>
				</div>
			</div>
			<div class="title">Anasayfa Slider</div>
		</a>
	</div>
@endcanany
@canany(['social_links_access'])
	<div class="item{{ $menu['item'] === "social_links" ? " active" : "" }}">
		<a draggable="false" class="link" href="{{route("admin.social_links.index")}}">
			<div class="icon">
				<div class="font-awesome-icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M0 96C0 60.7 28.7 32 64 32H512c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96zM128 288a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm32-128a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM128 384a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm96-248c-13.3 0-24 10.7-24 24s10.7 24 24 24H448c13.3 0 24-10.7 24-24s-10.7-24-24-24H224zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24H448c13.3 0 24-10.7 24-24s-10.7-24-24-24H224zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24H448c13.3 0 24-10.7 24-24s-10.7-24-24-24H224z"/></svg>
				</div>
			</div>
			<div class="title">İletişim Bilgileri</div>
		</a>
	</div>
@endcanany
@canany(['markalar_access'])
	<div class="item{{ $menu['item'] === "markalar" ? " active" : "" }}">
		<a draggable="false" class="link" href="{{route("admin.markalar.index")}}">
			<div class="icon">
				<div class="font-awesome-icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16H224v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm56 256c-13.3 0-24 10.7-24 24s10.7 24 24 24H264c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24H264c13.3 0 24-10.7 24-24s-10.7-24-24-24H120z"/></svg>
				</div>
			</div>
			<div class="title">Markalar</div>
		</a>
	</div>
@endcanany