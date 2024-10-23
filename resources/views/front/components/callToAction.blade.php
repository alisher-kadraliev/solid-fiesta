<section class="relative section-space bg-primary">
    <div class="relative max-w-[1490px] mx-auto">
        <div class="container relative">
            <div class="flex flex-col gap-4 justify-center items-center mx-auto">
                @if('$fixedContent')
                    <div class="text-white font-normal text-lg">{{$fixedContent->call_to_action_title}}</div>
                    <div class="text-white font-bold text-2xl">{{$fixedContent->call_to_action_alt_title}}</div>
                @endif
                <a href=""
                   class="btn-primary text-white border-white border-2 font-normal px-4 py-3 hover:bg-white hover:text-black transition-all">Lorem,
                    ipsum;</a>
            </div>
        </div>
    </div>
</section>
