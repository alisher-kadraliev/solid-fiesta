@extends('front.layouts.app')
@section('title','İletişim')
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
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d12730.298150758725!2d30.627216!3d37.09143900000001!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzfCsDA1JzI5LjMiTiAzMMKwMzcnNDUuMyJF!5e0!3m2!1str!2str!4v1729583488950!5m2!1str!2str"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>

            <section class="relative section-space z-10">
                <div class="relative max-w-[1490px] mx-auto">
                    <div class="container relative">
                        <div class=" gap-1 grid grid-cols-4 max-lg:grid-cols-2 max-sm:grid-cols-1 max-sm:justify-center">
                            <div class="flex flex-col gap-3 justify-center items-center">
                                <img src="{{asset('assets/front/img/loc.svg')}}" class="w-20 h-auto fill-primary text-primary stroke-primary" alt="">
                                <div class="font-bold text-2xl">Adres</div>
                                <div class="text-black/50 w-1/2 text-center max-lg:w-full text-sm">A.O.S.B. Antalya Toptancılar Bir. Sit. 108/5
                                    Döşemealtı / ANTALYA</div>
                            </div>
                            <div class="flex flex-col gap-3 justify-center items-center">
                                <img src="{{asset('assets/front/img/phone-vita.svg')}}" class="w-20 h-auto fill-primary text-primary stroke-primary" alt="">
                                <div class="font-bold text-2xl">Phone</div>
                                <a href="tel:+902425027007" class="text-black/50 text-center max-lg:w-full text-sm hover:underline">+90 242 502 70 07</a>
                            </div>
                            <div class="flex flex-col gap-3 justify-center items-center">
                                <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M3.75 5.25L3 6V18L3.75 18.75H20.25L21 18V6L20.25 5.25H3.75ZM4.5 7.6955V17.25H19.5V7.69525L11.9999 14.5136L4.5 7.6955ZM18.3099 6.75H5.68986L11.9999 12.4864L18.3099 6.75Z"
                                          fill="#1da12e" />
                                </svg>
                                <div class="font-bold text-2xl">Eposta</div>
                                <a href="mailto:info@vitatarim.com.tr"
                                   class="text-black/50 text-center max-lg:w-full  hover:underline">info@vitatarim.com.tr</a>
                            </div>
                            <div class="flex flex-col gap-3 justify-center items-center">
                                <img src="{{asset('assets/front/img/cal.svg')}}" class="w-20 h-auto fill-primary text-primary stroke-primary" alt="">
                                <div class="font-bold text-2xl">Çalışma saatleri</div>
                                <div class="text-black/50 text-center max-lg:w-full text-sm">Pzt - Cmt 9:30 - 18:00 / Paz - KAPALI</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="relative section-space z-10">
                <div class="relative max-w-[1490px] mx-auto">
                    <div class="container relative">
                        <div>
                            <div class="font-bold text-2xl">Bize yazın</div>
                            <div class="text-black/50">Aşağıdaki iletişim formunu kullanarak bize rahatça ulaşabilirsiniz.</div>
                        </div>
                        <form action="">
                            <div class="flex gap-3">
                                <input type="text" placeholder="Adınız" class="w-full p-4 bg-black/5 mt-3">
                                <input type="text" placeholder="E posta" class="w-full p-4 bg-black/5 mt-3">
                            </div>
                            <input type="text" placeholder="Konu" class="w-full p-4 bg-black/5 mt-3">
                            <textarea name="" id="" placeholder="Mesajınız" class="w-full p-4 bg-black/5 mt-3"></textarea>
                            <button class="bg-primary text-white px-4 py-3 mt-6">Gönder</button>
                        </form>
                    </div>
                </div>
            </section>

     @include('front.components.callToAction')
@endsection
