<main class="mt-[26px] h-[85%]">
    <div class="bg-white shadow-sm rounded-3xl w-full p-[30px] min-h-[300px] mb-5 h-full overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-3 bg-secondary-60">

        </div>
        {{-- <div class="flex items-center gap-4 mb-10">
            <div class="[&>svg>path]:fill-secondary-100">
                {!! file_get_contents('assets/icons/document.svg') !!}
            </div>
            <div class="font-bold text-md text-black-80">
                Page Title
            </div>
        </div> --}}

        <div class="flex flex-col items-center justify-center w-full h-full">
            {!! file_get_contents('assets/images/illustration/denied.svg') !!}
            <div class="text-center text-neutral-70">
                {{-- <div class="">
                    Role / Hak Akses <span class="font-medium capitalize text-secondary-60">"{{\Auth::user()->roles[0]->name}}"</span> telah dinonaktifkan
                </div> --}}
                <div class="mt-1 text-sm">
                    Silahkan hubungi Admin terkait role tersebut
                </div>
            </div>
        </div>
    </div>
</main>