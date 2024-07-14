<div
    class="bg-white flex flex-1 {{$wrapperClass??'flex-col'}} items-center drop-shadow-[0px_1px_6px_rgba(54,118,177,0.25)] rounded-lg w-[523px] h-[112px] p-6 gap-4">
    @if (!isset($icon))
    <div class="bg-primary-10 w-[60px] h-[60px] items-center p-3 rounded-lg ">
        {!! file_get_contents('assets/icons/outline-cube.svg') !!}
    </div>
    @else
        {{ $icon ?? '' }}
    @endif
    
    <div class="flex flex-col items-baseline self-stretch justify-around">
        <div class="text-neutral-60">
            {{ $title }}
        </div>
        <div class="mt-1 mb-2 font-bold text-primary-90 text-heading2">
            {{ $value }}
        </div>
    </div>
</div>
