@extends('front.layouts.app')
@section('content')

    <section class="relative overflow-hidden">
        <div class="swiper swiper-hero max-lg:h-[500px]">
            <div class="swiper-wrapper">
                @foreach($sliders as $item)
                    <div class="swiper-slide overflow-hidden ">
                        <img src="{{$item->foto}}"
                             class="w-full object-cover h-auto hero-animate max-lg:h-[500px]" alt="">
                        <div
                            class="flex flex-col justify-center items-start pl-32 max-lg:pl-10 mx-auto absolute top-0 left-0 w-full h-full"
                            data-aos="fade-up" data-aos-duration="1000">
                            <div
                                class="text-white text-5xl font-bold animate__animated animate__fadeInUp">{{$item->title}}</div>
                            <div
                                class="text-white text-xl animate__animated animate__fadeInUp">{{$item->alt_title}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- <div class="custom-pagination"></div> -->
        </div>
        <div class="absolute bottom-[-100%] left-[10%] w-32 xl:w-42 xl:h-[1240px] bg-white max-lg:hidden z-10 transform rotate-[-85deg]"></div>
        <div class="absolute bottom-[-100%] right-[10%] w-32 xl:w-42 xl:h-[1240px] bg-white max-lg:hidden z-10 transform rotate-[85deg]"></div>
    </section>
    <section>
        <div class="container my-16">
            <div class="flex max-lg:flex-col gap-10 ">
                <div class="flex flex-col gap-3 w-1/3 max-lg:w-full" data-aos="fade-up" data-aos-duration="1000">
                    <div class="text-black font-bold text-2xl">
                        @if($fixedContent)
                         {{$fixedContent->title}}
                        @endif

                    </div>
                    <div>
                        @if('$fixedContent')
                        <img src="{{$fixedContent->image}}" class="w-72 h-auto" alt="logo">
                        @endif

                    </div>
                </div>
                <div class="flex flex-col gap-3 w-2/3 max-lg:w-full" data-aos="fade-up" data-aos-duration="1500">
                    <div class="text-black/40">
                        @if($fixedContent)
                             {{$fixedContent->description}}
                        @endif                    </div>
                    <div>
                        <a href="" class="btn-primary text-primary font-bold">Daha Fazla.&#43;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('front.components.products')
    <section class="relative section-space">
        <div class="flex gap-4 max-lg:flex-col max-lg:px-5 ">
            <div class="w-1/2 max-lg:w-full relative">
                <div class="absolute top-[-18%] right-[-25%] w-72 z-0 h-72 bg-white transform rotate-[75deg] max-lg:hidden">
                </div>
                <div
                    class="absolute bottom-[-18%] right-[-25%] w-72 z-0 h-72 bg-white transform rotate-[-75deg] max-lg:hidden">
                </div>
                @if($fixedContent)
                <img src="{{$fixedContent->about_foto}}" class="w-full h-[422px] object-cover"
                     alt="">
                @endif
            </div>
            <div class="w-1/2 max-lg:w-full flex flex-col gap-3 justify-center items-start pr-20 max-lg:pr-0 z-10">
                <div class="flex items-center gap-3">
                    @if($fixedContent)
                    <h2 class="text-primary font-bold text-2xl">{{$fixedContent->about1}}</h2>
                    @endif

                    <div class="text-black font-normal text-2xl">Hoşgeldiniz</div>
                </div>
                @if($fixedContent)
                <div class="text-black/60">{{$fixedContent->about_top_desc}}</div>
                @endif
                    @if($fixedContent)
                <div class="text-black/30">{{$fixedContent->about_down_desc}}</div>
                @endif
            </div>
        </div>
        <div class="flex gap-4 max-lg:flex-col-reverse max-lg:px-5 mt-24 max-lg:mt-10">
            <div class="w-1/2 max-lg:w-full flex flex-col gap-3 justify-center items-start pl-20 max-lg:pl-0 z-10 ">
                <div class="flex items-center gap-3">
                    @if($fixedContent)
                        <h2 class="text-primary font-bold text-2xl">{{$fixedContent->about2}}</h2>
                    @endif
                    <div class="text-black font-normal text-2xl">Hoşgeldiniz</div>
                </div>
                @if($fixedContent)
                    <div class="text-black/60">{{$fixedContent->about_top_desc_2}}</div>
                @endif
                @if($fixedContent)
                    <div class="text-black/30">{{$fixedContent->about_down_desc_2}}</div>
                @endif
            </div>
            <div class="w-1/2 max-lg:w-full relative">
                <div class="absolute top-[0%] right-[80%] w-72 z-0 h-44 bg-white transform rotate-[-75deg] max-lg:hidden">
                </div>
                <div class="absolute bottom-[0%] right-[80%] w-72 z-0 h-44 bg-white transform rotate-[75deg] max-lg:hidden">
                </div>
                @if($fixedContent)
                <img src="{{$fixedContent->about_foto_2}}"
                     class="w-full h-[422px] max-lg:h-auto object-cover" alt="">
                @endif
            </div>
        </div>
    </section>
    <section class="relative section-space bg-[#f1f1f1]">
        <div class="relative max-w-[1490px] mx-auto">
            <div class="container relative">
                <h2 class="text-black font-bold text-2xl text-center">Markalar</h2>
                <div class="swiper swiper-marka">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://www.vitatarim.com.tr/app/uploads/brands/agropol-logos-242.png"
                                 class="w-32 object-contain h-auto flex max-lg:mx-auto" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://www.vitatarim.com.tr/app/uploads/brands/agropol-logos-242.png"
                                 class="w-32 object-contain h-auto flex max-lg:mx-auto" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://www.vitatarim.com.tr/app/uploads/brands/agropol-logos-242.png"
                                 class="w-32 object-contain h-auto flex max-lg:mx-auto" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://www.vitatarim.com.tr/app/uploads/brands/agropol-logos-242.png"
                                 class="w-32 object-contain h-auto flex max-lg:mx-auto" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://www.vitatarim.com.tr/app/uploads/brands/agropol-logos-242.png"
                                 class="w-32 object-contain h-auto flex max-lg:mx-auto" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://www.vitatarim.com.tr/app/uploads/brands/agropol-logos-242.png"
                                 class="w-32 object-contain h-auto flex max-lg:mx-auto" alt="">
                        </div> <div class="swiper-slide">
                            <img src="https://www.vitatarim.com.tr/app/uploads/brands/agropol-logos-242.png"
                                 class="w-32 object-contain h-auto flex max-lg:mx-auto" alt="">
                        </div>
                    </div>
                    <div class="swiper-button-prev lg:hidden"></div>
                    <div class="swiper-button-next lg:hidden"></div>
                </div>
            </div>
        </div>
    </section>
 @include('front.components.callToAction')
@endsection
