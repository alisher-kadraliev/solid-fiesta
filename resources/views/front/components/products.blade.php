<section class="relative section-space z-10">
    <div class="relative max-w-[1490px] mx-auto">
        <div class="container relative">
            <div class="flex flex-col mb-5 gap-3 justify-center items-center mx-auto" data-aos="fade-up"
                 data-aos-duration="1000">
                @if($fixedContent)
                    <h2 class="text-primary font-bold text-4xl">{{$fixedContent->product_catalog_title}}</h2>
                @endif
                <a href="" target="_blank" class="text-primary font-bold text-2xl">Katalog indir</a>
                <hr class="w-32 max-lg:w-full border-black/20">
                @if($fixedContent)
                    <div class="text-black/40 w-1/2 max-lg:w-full text-center">
                        {{$fixedContent->product_catalog_desc}}
                    </div>
                @endif
            </div>
            <div
                class="grid grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1 gap-10 justify-center items-center mx-auto">
                <a href=""
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
