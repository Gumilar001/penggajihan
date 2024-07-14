<div class="flex items-center justify-between flex-1 rounded-lg border border-neutral-30 p-4 min-h-[117px] !pb-0">
    <div class="mb-4">
        <div class="text-xs text-neutral-70 mb-1">{{$title}}</div>
        <div class="font-semibold text-lg">
            {{$value}}
        </div>
    </div>
    <div class="self-stretch flex flex-col">
        <div class="text-[10px] text-neutral-70 font-medium py-[2px] px-1 rounded bg-neutral-20 text-center min-w-[100px]">
            {{$range}}
        </div>
        <div class="text-[10px] mt-auto text-center relative">
            {{$chart}}
        </div>
    </div>
</div>