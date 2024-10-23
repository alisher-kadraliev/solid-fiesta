@extends('front.layouts.app')
@section('title','Medya')
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

                    <div class="grid grid-cols-3 gap-4">
                        <a href="https://vitatarim.com.tr/app/uploads/media/aninoacids-186.png"
                           class="group relative transition-all" data-fancybox="media-image">
                            <div class="absolute top-0 left-0 w-full h-full bg-black/30 hidden group-hover:block transition-all">
                            </div>
                            <div
                                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white text-4xl font-bold hidden group-hover:block transition-all">
                                &#43;
                            </div>
                            <img src="https://vitatarim.com.tr/app/uploads/media/aninoacids-186.png"
                                 class="h-[250px] max-lg:h-auto object-cover w-auto transition-all" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>




     @include('front.components.callToAction')
@endsection
