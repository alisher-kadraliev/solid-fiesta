@extends('front.layouts.app')
@section('title','Bambus arılar')
@section('content')

    <section
        class=" z-10 relative bg-[url('https://www.vitatarim.com.tr/app/uploads/banner/basliksiz-2-294.jpg')] bg-cover bg-center">
        <div class="bg-black/30 absolute top-0 left-0 w-full h-full"></div>
        <div class="container py-16 ">
            <div class="flex gap-4 justify-between items-center">
                <h1 class="text-white font-bold text-4xl z-10">@yield('title')</h1>
                <div class="flex gap-2 z-10">
                    <a href="" class="text-primary font-normal hover:underline">Anasayfa</a>
                    <div class="text-white font-normal">&rsaquo;</div>
                    <div class="text-white font-normal ">@yield('title')</div>
                </div>
            </div>
        </div>
    </section>


    <section class="relative section-space z-10">
        <div class="relative max-w-[1490px] mx-auto">
            <div class="container relative">
                <div class="flex gap-4 max-lg:flex-col">
                    <div class="gap-4 w-1/2 max-lg:w-full">
                        <div class="swiper swiper-fertilizer mb-10 ">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a class=" relative"
                                       href="https://www.vitatarim.com.tr/app/uploads/fertilizer_image/646f44a66d8ad.jpg"
                                       data-fancybox="fertilizer-image">
                                        <img src="https://www.vitatarim.com.tr/app/uploads/fertilizer_image/646f44a66d8ad.jpg"
                                             class="w-auto h-[400px] max-lg:w-full max-lg:h-full object-cover group-hover:scale-105 transition-all"
                                             alt="">
                                        <img src="{{asset('assets/front/img/search.svg')}}"
                                             class="absolute right-0 bottom-0 w-10 h-10 object-cover bg-primary p-2 rounded-full transition-all"
                                             alt="">
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a class="relative"
                                       href="https://www.vitatarim.com.tr/app/uploads/fertilizer_image/646f453d519df.jpg"
                                       data-fancybox="fertilizer-image">
                                        <img src="https://www.vitatarim.com.tr/app/uploads/fertilizer_image/646f453d519df.jpg"
                                             class="w-auto h-[400px] max-lg:w-full max-lg:h-full object-cover group-hover:scale-105 transition-all"
                                             alt="">
                                        <img src="{{asset('assets/front/img/search.svg')}}"
                                             class="absolute right-0 bottom-0 w-10 h-10 object-cover bg-primary p-2 rounded-full transition-all"
                                             alt="">
                                    </a>
                                </div>

                            </div>

                        </div>
                        <div class="swiper swiper-fertilizer-mini">
                            <div class="swiper-wrapper ">
                                <div class="swiper-slide cursor-pointer">
                                    <img src="https://www.vitatarim.com.tr/app/uploads/fertilizer_image/646f44a66d8ad.jpg"
                                         class="rounded-xl" alt="">
                                </div>
                                <div class="swiper-slide cursor-pointer">
                                    <img src="https://www.vitatarim.com.tr/app/uploads/fertilizer_image/646f453d519df.jpg"
                                         class="rounded-xl" alt="">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 max-lg:w-full">
                        <h2 class="text-black font-bold text-2xl">title</h2>
                        <div class="text-black/60">desc</div>
                        <div class="flex gap-3">
                            <div>Durumu</div>
                            <div class="text-primary font-semibold">Stokta var</div>
                        </div>
                    </div>
                </div>

                <div class="text-black text-2xl mt-9 font-bold">Açıklama</div>
            </div>
        </div>
    </section>



    @include('front.components.callToAction')
@endsection
