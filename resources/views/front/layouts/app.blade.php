<!doctype html>
<html lang="tr">

<head>
    <meta charset="UTF-8"/>
    <link rel="icon" type="image/svg+xml" href=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title','Title')</title>
    <!-- css -->
    <link href="{{asset('assets/front/css/output.css')}}" rel="stylesheet">
    <!-- cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.12/build/css/intlTelInput.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"/>
    @vite('resources/css/app.css')

</head>

<body>

<header class="bg-white flex flex-col">
    <div class="container mt-1">
        <div class="flex gap-4 justify-between items-center max-lg:mt-6">
            <div class="flex gap-5 items-center max-lg:hidden">
                <a href="" target="_blank"
                   class="flex items-center gap-2 font-bold text-md text-primary transition-all hover:text-underline">
            <span>
              <img src="{{asset('assets/front/img/phone-vita.svg')}}" class="w-7 h-auto" alt="">
            </span>
                    <span class="hover:underline">
    @if($socialLinks)
                            {{ $socialLinks->telefon_numaras }}
                        @endif
            </span>

                </a>
                <a href="" target="_blank"
                   class="flex items-center gap-2 font-normal text-sm text-black/50 transition-all hover:underline"><span>
              <img src="{{asset('assets/front/img/email.svg')}}" class="w-5 h-auto" alt="">
            </span>
                    <span class="hover:underline">
             @if($socialLinks)
                            {{ $socialLinks->email }}
                        @endif
            </span></a>
                <div
                    class="flex items-center gap-2 font-normal text-sm text-black/50 transition-all hover:underline"><span>
              <img src="{{asset('assets/front/img/time.svg')}}" class="w-5 h-auto" alt="">
            </span>
                    <span class="hover:underline">
              @if($socialLinks)
                            {{ $socialLinks->working_hours }}
                        @endif
            </span>
                </div>
            </div>


            <div
                class="flex gap-7 max-lg:justify-between items-center max-lg:w-full max-sm:flex-wrap max-sm:justify-center max-sm:gap-4">
                <div class="flex gap-2 items-center">
                    @if($socialLinks)
                        <a href="{{ $socialLinks->facebook }}" target="_blank" class=" transition-all hover:scale-110">
                            <img src="{{asset('assets/front/img/facebook-svgrepo-com.svg')}}" class="p-3 w-10 h-10"
                                 alt="">
                        </a>
                    @endif
                    @if($socialLinks)
                        <a href="{{ $socialLinks->instagram }}" target="_blank" class=" transition-all hover:scale-110">
                            <img src="{{asset('assets/front/img/instagram-svgrepo-com.svg')}}" class="p-3 w-10 h-10"
                                 alt="">
                        </a>
                    @endif
                    @if($socialLinks)
                        <a href="{{ $socialLinks->twitter }}" target="_blank" class=" transition-all hover:scale-110">
                            <img src="{{asset('assets/front/img/youtube-svgrepo-com.svg')}}" class="p-3 w-10 h-10"
                                 alt="">
                        </a>
                    @endif
                </div>
                <div>
                    <img src="{{asset('assets/front/img/logo.png')}}" class="w-10 h-auto" alt="">
                </div>
                <div class="h-16 flex items-center justify-end">
                    @if($socialLinks)
                    <a href="{{$socialLinks->katalog_indir_linki}}" target="_blank" class="bg-primary text-white px-4 py-5 max-lg:py-2">
                        Katalog indir
                    </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <hr class="border-black/5 border">
    <div class="" id="nav-scroll">
        <nav class="mx-auto flex max-w-6xl items-center justify-between gap-3  max-lg:px-6" aria-label="Global">
            <a href="/">
                <img src="https://www.vitatarim.com.tr/public/site/img/site/logo.png" class="w-72 h-auto" alt="logo">
            </a>
            <div class="flex lg:hidden">
                <button id="openBtnNav" type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-5">
                <a href="#" class="text-sm font-semibold text-gray-900  transition-all hover:text-primary">Anasayfa</a>

                <div class="relative group">
                    <a href="{{route('productsCategories')}}" type="button" id="menuBtn"
                       class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900  group-hover:text-primary transition"
                       aria-expanded="false">
                        Gübreler
                        <svg class="h-5 w-5 flex-none text-gray-400 transition-all group-hover:rotate-180 transform"
                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <div id="subMenu"
                         class="subMenu absolute top-full z-50 overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-primary">
                        <div class="p-4">
                            <div
                                class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                                <div class="flex-auto">
                                    <a href="#"
                                       class="block font-semibold text-gray-900 hover:text-primary transition-all">
                                        Analytics
                                        <span class="absolute inset-0"></span>
                                    </a>
                                </div>
                            </div>
                            <div
                                class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
                                <div class="flex-auto">
                                    <a href="#"
                                       class="block font-semibold text-gray-900 hover:text-primary transition-all">
                                        Analytics
                                        <span class="absolute inset-0"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{route('bombusbee')}}"
                   class="text-sm font-semibold leading-6 text-gray-900  hover:text-primary transition-all">Bombus
                    Arıları</a>
                <a href="{{route('about')}}"
                   class="text-sm font-semibold leading-6 text-gray-900  hover:text-primary transition-all">Hakkımızda</a>
                <a href="{{route('media')}}"
                   class="text-sm font-semibold leading-6 text-gray-900  hover:text-primary transition-all">Medya</a>
                <a href="{{route('certificate')}}"
                   class="text-sm font-semibold leading-6 text-gray-900  hover:text-primary transition-all">Bilgiler</a>
                <a href="{{route('contact')}}"
                   class="text-sm font-semibold leading-6 text-gray-900  hover:text-primary transition-all">İletişim</a>


        </nav>
    </div>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div id="mbContent" class="lg:hidden hidden" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-10"></div>
        <div
            class="fixed  z-50 inset-y-0 right-0 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 ">
            <div class="flex items-end justify-end">
                <button id="closeBtnNav" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-10">
                        <a href="#"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Anasayfa</a>
                        <div class="-mx-3">
                            <button type="button" id="mobile-menu-btn"
                                    class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                                    aria-expanded="false">
                                Tedaviler
                                <svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <div class="mt-2 space-y-2 subMenuMb" id="mobile-menu">
                                <a href="#"
                                   class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Analytics</a>
                                <a href="#"
                                   class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Engagement</a>
                            </div>
                        </div>
                        <a href="#"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Hakkımızda</a>
                        <a href="#"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Gülüş
                            galerisi</a>
                        <a href="#"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">SSS</a>
                        <a href="#"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">İletişim</a>

                    </div>
                    <div class="py-6">
                        <div class="flex items-center justify-start pr-16 lg:pr-0">
                            <div class="">
                                <div class="dropdown">
                                    <button id="dropdown2Toggle"
                                            class="dropdown-button rounded py-2 px-6 text-base border-none cursor-pointer flex flex-row items-center justify-center gap-2 font-semibold">
                                        TR
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 pointer-events-none"
                                             viewBox="0 0 24 24"
                                             fill="currentColor">
                                            <path
                                                d="M11.9999 13.1714L16.9497 8.22168L18.3639 9.63589L11.9999 15.9999L5.63599 9.63589L7.0502 8.22168L11.9999 13.1714Z">
                                            </path>
                                        </svg>
                                    </button>
                                    <div id="dropdown2"
                                         class="dropdown-content translate-y-2 rounded hidden absolute bg-[#f1f1f1] w-[100px] max-w-[260px] overflow-auto shadow-xl z-10">
                                        <a href=""
                                           class="text-black flex flex-row items-start justify-start gap-2 py-2 px-4 text-sm hover:bg-[#ddd] font-semibold">
                                            EN
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    @yield('content')

</main>
<footer>

    <div class="bg-[#222529] text-white">
        <div class="container">
            <div class="flex flex-col gap-10 pt-20 pb-10 max-lg:pb-20">
                <div class="grid grid-cols-4 max-lg:grid-cols-2 max-md:grid-cols-1 gap-10 justify-between">
                    <div class="flex flex-col gap-8">
                        <a href="">
                            <img src="https://www.vitatarim.com.tr/public/site/img/site/logo.png"
                                 class="w-[200px] mt-40 max-lg:mt-0 max-lg:w-full" alt="Footer Logo">
                        </a>

                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="relative flex mb-4">
                            <h2 class="text-white  text-xl !text-start uppercase">bize ulaş</h2>
                        </div>
                        <div class="flex gap-10">
                            <div class="flex flex-col">
                                <div class="flex flex-col gap-2">
                                    <div class="text-[#777777] uppercase">Adres</div>
                                    @if($socialLinks)
                                        <div>{{$socialLinks->adres}}</div>
                                    @endif

                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="text-[#777777] uppercase">Telefon</div>
                                    @if($socialLinks)
                                    <a href="tel:+902425027007" class="hover:text-secondary transition-all">{{$socialLinks->telefon_numaras}}</a>
                                    @endif
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="text-[#777777] uppercase">Eposta</div>
                                    <a href="mailto:info@vitatarim.com.tr"
                                       class="hover:text-secondary transition-all">info@vitatarim.com.tr</a>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <div class="text-[#777777] uppercase">Çalışma saatleri</div>
                                    <div>Pzt - Cmt 9:30 - 18:00 / Paz - KAPALI</div>
                                </div>
                                <div class="flex gap-4 mt-4">
                                    <a href="" class="border border-white rounded-full transition-all hover:scale-110">
                                        <img src="{{asset('assets/front/img/facebook-svgrepo-com-white.svg')}}" class="p-3  " alt="">
                                    </a>
                                    <a href="" class="border border-white rounded-full transition-all hover:scale-110 ">
                                        <img src="{{asset('assets/front/img/instagram-svgrepo-com-white.svg')}}" class="p-3 " alt="">
                                    </a>
                                    <a href="" class="border border-white rounded-full transition-all hover:scale-110 ">
                                        <img src="{{asset('assets/front/img/youtube-svgrepo-com-white.svg')}}" class="p-3 " alt="">
                                    </a>
                                    <a href="" class="border border-white rounded-full transition-all hover:scale-110 ">
                                        <img src="{{asset('assets/front/img/whatsapp-svgrepo-com-white.svg')}}" class="p-3 " alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="relative flex mb-4">
                            <h2 class="text-white text-xl !text-start">Kurumsal</h2>
                        </div>
                        <div class="flex gap-10">
                            <div class="flex flex-col">
                                <a href="" class="pb-1 text-[#777777] transition-all">Anasayfa</a>
                                <a href="" class="pb-1 text-[#777777] transition-all">Anasayfa</a>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <div class="relative flex mb-4">
                            <h2 class="text-white text-xl !text-start">Bület</h2>
                        </div>
                        <form action="" class="flex">
                            <input type="text" class="w-full p-4 text-lg" placeholder="E-posta adresinizi giriniz">
                            <button
                                class="btn-primary text-white border-white border-2 font-normal px-4 py-3 hover:bg-primary hover:text-white transition-all">
                                Gönder
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex justify-between items-center max-lg:flex-col border-t border-white/20">
                    <div class="flex flex-col gap-2 mx-auto mt-6 justify-center items-center">
                        <div class="text-white max-lg:text-center">© Copyrights 2023. Tüm Hakları Saklıdır.</div>
                        <a href="https://moonworkshop.com" target="_blank">
                            <img src="https://www.vitatarim.com.tr/public/site/img/site/atilimmedya.png"
                                 alt="moonworkshop">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div>
    <div class="" id="">
        <div class="whatsapp-main">
            <div type="floating" class="whatsapp-wrapper hide-whatsapp" style="width: 360px;">
                <div color="rgb(29, 33, 41)" role="button" tabindex="0" class="close_whatsapp"></div>
                <div class="whatsapp-header">
                    <div size="52" class="support-avatar">
                        <div class="avatar-wrapper">
                            <div class="avatar-img"
                                 style="background-image:url(https://ozaytarim.moonsunum.com/upload/settings/logo-1.webp);"></div>
                        </div>
                    </div>
                    <div class="header-info">
                        <div class="whatsapp-name">Test title</div>
                        <div class="whatsapp-reply-time">Çevrimiçi</div>
                    </div>
                </div>
                <div class="whatsapp-background">
                    <div class="whatsapp-message-container">
                        <div class="loading-animation">
                            <div class="dot-pulse"></div>
                        </div>
                        <div class="whatsapp-message-wrapper">
                            <div class="chat-body-wrapper">
                                <div class="whatsapp-chat-name">title</div>
                                <div class="whatsapp-chat-message">
                                    <div>
                                        <p>deneme</p>
                                    </div>
                                </div>
                                <div class="whatsapp-chat-time">16:54</div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="https://wa.me/902425027007?text=deneme" title="WhatsApp" class="whatsapp-btn" role="button"
                   target="popup"
                   onclick="window.open('https://wa.me/902425027007?text=deneme','popup','width=700,height=600'); return false;">
                    <svg class="whatsapp-send-icon-small" xmlns="http://www.w3.org/2000/svg" version="1" height="20"
                         viewBox="0 0 90 90">
                        <path
                            d="M90 44a44 44 0 0 1-66 38L0 90l8-24A44 44 0 0 1 46 0c24 0 44 20 44 44zM46 7C25 7 9 24 9 44c0 8 2 15 7 21l-5 14 14-4a37 37 0 0 0 58-31C83 24 66 7 46 7zm22 47l-2-1-7-4-3 1-3 4h-3c-1 0-4-1-8-5-3-3-6-6-6-8v-2l2-2 1-1v-2l-4-8c0-2-1-2-2-2h-2l-3 1c-1 1-4 4-4 9s4 11 5 11c0 1 7 12 18 16 11 5 11 3 13 3s7-2 7-5l1-5z"
                            fill="#FFF"/>
                    </svg>
                    <span class="chat-button-text">Whatsapp Sohbet</span>
                </a>
                <div style="display: flex; justify-content: center; align-items: center;"></div>
            </div>
        </div>
    </div>
</div>
<headers>
    <a href="javascript:;" class="form-btn-mobile bg-primary">
        We Call You</a>
    <div class="whatsappx">
        <div class="whatsapp-popup-button play-btn" id="whatsapp-popup">
            <div class="whatsapp-button-main">
                WHATSAPP
            </div>
        </div>
    </div>
</headers>
<article class="uzmanina-sor-mobil">
    <div class="uzman-content">
        <div class="container">
            <div class="row pt-5-m">
                <div class="col-md-9">
                    <div class="form-area">
                        <span class="close-btn-form">&times;</span>
                        <form action="" method="post" class="form-mobil">
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Ad" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Soyad" required>
                            </div>
                            <div class="form-group">
                                <input id="phonemobile" name="phone" type="tel" placeholder="Telefon Numarası" required>
                            </div>
                            <div class="form-group">
                                <input id="email" name="email" type="email" placeholder="E-posta" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="bg-secondary" name="button">Gönder</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 mt-3-m">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="white">
                        <path
                            d="M7.25361 18.4944L7.97834 18.917C9.18909 19.623 10.5651 20 12.001 20C16.4193 20 20.001 16.4183 20.001 12C20.001 7.58172 16.4193 4 12.001 4C7.5827 4 4.00098 7.58172 4.00098 12C4.00098 13.4363 4.37821 14.8128 5.08466 16.0238L5.50704 16.7478L4.85355 19.1494L7.25361 18.4944ZM2.00516 22L3.35712 17.0315C2.49494 15.5536 2.00098 13.8345 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22C10.1671 22 8.44851 21.5064 6.97086 20.6447L2.00516 22ZM8.39232 7.30833C8.5262 7.29892 8.66053 7.29748 8.79459 7.30402C8.84875 7.30758 8.90265 7.31384 8.95659 7.32007C9.11585 7.33846 9.29098 7.43545 9.34986 7.56894C9.64818 8.24536 9.93764 8.92565 10.2182 9.60963C10.2801 9.76062 10.2428 9.95633 10.125 10.1457C10.0652 10.2428 9.97128 10.379 9.86248 10.5183C9.74939 10.663 9.50599 10.9291 9.50599 10.9291C9.50599 10.9291 9.40738 11.0473 9.44455 11.1944C9.45903 11.25 9.50521 11.331 9.54708 11.3991C9.57027 11.4368 9.5918 11.4705 9.60577 11.4938C9.86169 11.9211 10.2057 12.3543 10.6259 12.7616C10.7463 12.8783 10.8631 12.9974 10.9887 13.108C11.457 13.5209 11.9868 13.8583 12.559 14.1082L12.5641 14.1105C12.6486 14.1469 12.692 14.1668 12.8157 14.2193C12.8781 14.2457 12.9419 14.2685 13.0074 14.2858C13.0311 14.292 13.0554 14.2955 13.0798 14.2972C13.2415 14.3069 13.335 14.2032 13.3749 14.1555C14.0984 13.279 14.1646 13.2218 14.1696 13.2222V13.2238C14.2647 13.1236 14.4142 13.0888 14.5476 13.097C14.6085 13.1007 14.6691 13.1124 14.7245 13.1377C15.2563 13.3803 16.1258 13.7587 16.1258 13.7587L16.7073 14.0201C16.8047 14.0671 16.8936 14.1778 16.8979 14.2854C16.9005 14.3523 16.9077 14.4603 16.8838 14.6579C16.8525 14.9166 16.7738 15.2281 16.6956 15.3913C16.6406 15.5058 16.5694 15.6074 16.4866 15.6934C16.3743 15.81 16.2909 15.8808 16.1559 15.9814C16.0737 16.0426 16.0311 16.0714 16.0311 16.0714C15.8922 16.159 15.8139 16.2028 15.6484 16.2909C15.391 16.428 15.1066 16.5068 14.8153 16.5218C14.6296 16.5313 14.4444 16.5447 14.2589 16.5347C14.2507 16.5342 13.6907 16.4482 13.6907 16.4482C12.2688 16.0742 10.9538 15.3736 9.85034 14.402C9.62473 14.2034 9.4155 13.9885 9.20194 13.7759C8.31288 12.8908 7.63982 11.9364 7.23169 11.0336C7.03043 10.5884 6.90299 10.1116 6.90098 9.62098C6.89729 9.01405 7.09599 8.4232 7.46569 7.94186C7.53857 7.84697 7.60774 7.74855 7.72709 7.63586C7.85348 7.51651 7.93392 7.45244 8.02057 7.40811C8.13607 7.34902 8.26293 7.31742 8.39232 7.30833Z">
                        </path>
                    </svg>

                    <div class="sticky-whatsapp">
                        {{--                        <a href="https://wa.me/{{ str_replace(' ', '', $settings->phone) }}?text=<?=urlencode('Saç Ekimi Fiyatları Hakkında Bilgi Alabilir Miyim?')?>"--}}
                        {{--                           target="_blank" name="whatsappyapisikalt" id="whatsappyapisikalt" class="whatsappyapisikalt">--}}

                        {{--                            +90 507 316 98 99--}}
                        {{--                            <br><span>ile iletişime geç!</span>--}}
                        {{--                        </a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/front/js/lang.js')}}"></script>
<script type="module" src="{{asset('assets/front/js/main.js')}}"></script>

<!-- cdn -->
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.12/build/js/intlTelInput.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>

</body>

</html>
