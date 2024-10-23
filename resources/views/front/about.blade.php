@extends('front.layouts.app')
@section('title','Hakkımızda')
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
        <section>
            <div class="container my-16">
                <div class="flex gap-4 max-lg:flex-col max-lg:px-5 ">
                    <div class="w-1/2 max-lg:w-full relative">
                        <div class="absolute top-[28%] right-[-5%] w-40 z-0 h-[600px] bg-white transform rotate-[30deg] max-lg:hidden">
                        </div>
                        <div class="absolute bottom-[28%] right-[-5%] w-40 z-0 h-[600px] bg-white transform rotate-[-30deg] max-lg:hidden">
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
                            <div class="text-black font-bold text-2xl">Hoşgeldiniz</div>
                        </div>
                        @if($fixedContent)
                        <div class="text-black/60">{{$fixedContent->about_top_desc}}</div>
                        <div class="text-black/30">{{$fixedContent->about_down_desc}}</div>
                        @endif
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
                    <img src="https://www.vitatarim.com.tr/public/site/img/site/bg/bg-1.jpg" class="w-full h-[422px] object-cover"
                         alt="">
                </div>
                <div class="w-1/2 max-lg:w-full flex flex-col gap-3 justify-center items-start pr-20 max-lg:pr-0 z-10">
                    <div class="flex items-center gap-3">
                        <h2 class="text-primary font-bold text-2xl">title</h2>
                        <div>Hoşgeldiniz</div>
                    </div>
                    <div class="text-black/60">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, sint!</div>
                    <div class="text-black/30">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur blanditiis
                        consequuntur corrupti libero! Assumenda, laboriosam aspernatur possimus dolorem et dolore. Necessitatibus,
                        laudantium? Numquam perferendis sed praesentium veniam. Error, dolor distinctio!</div>
                </div>
            </div>
            <div class="flex gap-4 max-lg:flex-col-reverse max-lg:px-5 mt-24 max-lg:mt-10">
                <div class="w-1/2 max-lg:w-full flex flex-col gap-3 justify-center items-start pl-20 max-lg:pl-0 z-10 ">
                    <div class="flex items-center gap-3">
                        <h2 class="text-primary font-bold text-2xl">title</h2>
                        <div>Hoşgeldiniz</div>
                    </div>
                    <div class="text-black/60">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, sint!</div>
                    <div class="text-black/30">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur blanditiis
                        consequuntur corrupti libero! Assumenda, laboriosam aspernatur possimus dolorem et dolore. Necessitatibus,
                        laudantium? Numquam perferendis sed praesentium veniam. Error, dolor distinctio!</div>
                </div>
                <div class="w-1/2 max-lg:w-full relative">
                    <div class="absolute top-[0%] right-[80%] w-72 z-0 h-44 bg-white transform rotate-[-75deg] max-lg:hidden">
                    </div>
                    <div class="absolute bottom-[0%] right-[80%] w-72 z-0 h-44 bg-white transform rotate-[75deg] max-lg:hidden">
                    </div>
                    <img src="https://www.vitatarim.com.tr/public/site/img/site/bg/bg-1.jpg"
                         class="w-full h-[422px] max-lg:h-auto object-cover" alt="">
                </div>
            </div>
        </section>

     @include('front.components.callToAction')
@endsection
