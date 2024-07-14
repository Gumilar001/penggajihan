<div class="flex flex-col mb-[21px]">
    <div class="font-bold text-sm">
        Ubah Password
    </div>
    <div class="text-xs text-neutral-70">
        Perbarui Password disini
    </div>
</div>

<div class="mb-3">
    <label for="" class="label mb-1">
        Password
    </label>
    <div class="relative">
        <div class="relative @error('postData.password') [&>input]:invalid @enderror">
            <input type="password" id="password" class="form-control"
                placeholder="Masukan Password disini.." wire:model.defer="postData.password">
            @error('postData.password')
                <x-ui.input-message>
                    @slot('message')
                        {{ $message }}
                    @endslot
                </x-ui.input-message>
            @enderror

            <div wire:ignore class="absolute h-[39px] flex items-center justify-center right-4 top-0">
                <i class="fas fa-eye-slash text-primary80 toggle-password text-neutral-90 cursor-pointer fs-12"></i>
            </div>
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="" class="label mb-1">
        Konfirmasi Password
    </label>
    <div class="relative @error('postData.password_confirmation') [&>input]:invalid @enderror {{(($postData['password'] != "" && $postData['password_confirmation'] != "") && ($postData['password'] != $postData['password_confirmation'])) ? '[&>input]:!border-light-secondary-orange' : ''}}">
        <input wire:ignore type="password" id="password_confirm"
            class="form-control"
            placeholder="Masukan Password disini.." wire:model.defer="postData.password_confirmation">
        @error('postData.password_confirmation')
            <x-ui.input-message>
                @slot('message')
                    {{ $message }}
                @endslot
            </x-ui.input-message>
        @enderror

        @if (($postData['password'] != "" && $postData['password_confirmation'] != "") && ($postData['password'] != $postData['password_confirmation']))
        <x-ui.input-message>
            @slot('message')
                Konfirmasi Password Tidak Sesuai
            @endslot
        </x-ui.input-message>
        @endif

        <div wire:ignore class="absolute h-[39px] flex items-center justify-center right-4 top-0">
            <i class="fas fa-eye-slash text-primary80 toggle-password text-neutral-90 cursor-pointer fs-12"></i>
        </div>
    </div>
</div>
