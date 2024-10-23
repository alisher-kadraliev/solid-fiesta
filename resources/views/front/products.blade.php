@extends('front.layouts.app')
@section('title','Gübreler')
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
                <div class="flex flex-col mb-5 gap-3 justify-center items-center mx-auto" data-aos="fade-up"
                     data-aos-duration="1000">
                    @if($fixedContent)
                        <h2 class="text-primary font-bold text-4xl">{{$fixedContent->product_catalog_title}}</h2>
                    @endif

                </div>
                <div
                    class="grid grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1 gap-10 justify-center items-center mx-auto">
                    <a href="{{route('product')}}"
                       class="flex flex-col gap-3 rounded-lg shadow-lg p-4 justify-center items-center group hover:shadow-xl transition-all">
                        <img src="https://www.vitatarim.com.tr/app/uploads/fertilizer_category/basliksiz-2-169-262.png"
                             class="w-[253px] h-[170px] object-cover" alt="">
                        <h3 class="text-black font-bold text-xl">test</h3>
                        <div
                            class=" text-black  border border-black  px-4 py-2 group-hover:border-primary group-hover:text-primary transition-all">
                            Lorem, ipsum</div>
                    </a>

                    <a href="{{route('product')}}"
                       class="flex flex-col gap-3 rounded-lg shadow-lg p-4 justify-center items-center group hover:shadow-xl transition-all">
                        <img src="https://www.vitatarim.com.tr/app/uploads/fertilizer_category/basliksiz-2-169-262.png"
                             class="w-[253px] h-[170px] object-cover" alt="">
                        <h3 class="text-black font-bold text-xl">test</h3>
                        <div
                            class=" text-black  border border-black  px-4 py-2 group-hover:border-primary group-hover:text-primary transition-all">
                            Lorem, ipsum</div>
                    </a>
                    <a href=""
                       class="flex flex-col gap-3 rounded-lg shadow-lg p-4 justify-center items-center group hover:shadow-xl transition-all">
                        <img src="https://www.vitatarim.com.tr/app/uploads/fertilizer_category/basliksiz-2-169-262.png"
                             class="w-[253px] h-[170px] object-cover" alt="">
                        <h3 class="text-black font-bold text-xl">test</h3>
                        <div
                            class=" text-black  border border-black  px-4 py-2 group-hover:border-primary group-hover:text-primary transition-all">
                            Lorem, ipsum</div>
                    </a>
                </div>
            </div>
        </div>
    </section>

     @include('front.components.callToAction')
@endsection
