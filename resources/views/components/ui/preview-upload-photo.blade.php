<div
    class="w-[120px] h-[120px] border border-dashed border-black-20 flex flex-col items-center justify-end rounded-lg relative">
    <div class="flex flex-col items-center my-auto pt-3">
        <div class="font-semibold text-sm max-w-[100px] text-ellipsis">
            {{ $fileName }}
        </div>
        <div class="text-xs text-black-60 my-1">
            {{ $fileSize }}
        </div>
        {{ $action }}
    </div>
</div>
