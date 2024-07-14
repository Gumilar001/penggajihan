<label for="{{ $labelFor }}"
    class="cursor-pointer w-[120px] h-[120px] border border-dashed border-black-20 flex flex-col items-center justify-center rounded-lg">
    <img src="{{ asset('assets/icons/upload-photo.svg') }}" alt="">
    <div class="text-xs text-black-60  mt-2">
        {{ $message ? $message : 'Browse File' }}
    </div>
    {{ $input }}
</label>
