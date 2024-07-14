<div>
    <div class="flex flex-col mb-[21px]">
        <div class="font-bold text-sm">
            Detail Pribadi
        </div>
        <div class="text-xs text-neutral-70">
            Perbarui foto dan detail pribadi anda
        </div>
    </div>

    <div class="mb-3">
        <label for="" class="label mb-1">
            Nama Lengkap
        </label>
        <input type="text" class="form-control @error('postDataProfile.name') invalid @enderror"
            placeholder="Example : Ardian Agustin" wire:model.defer="postDataProfile.name">
        @error('postDataProfile.name')
            <x-ui.input-message>
                @slot('message')
                    {{ $message }}
                @endslot
            </x-ui.input-message>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="label mb-1">
            Username
        </label>
        <input type="text" class="form-control @error('postDataProfile.username') invalid @enderror"
            placeholder="Example : ardianngustin" wire:model.defer="postDataProfile.username">
        @error('postDataProfile.username')
            <x-ui.input-message>
                @slot('message')
                    {{ $message }}
                @endslot
            </x-ui.input-message>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="label mb-1">
            Email
        </label>
        <input type="text" class="form-control @error('postDataProfile.email') invalid @enderror"
            placeholder="Masukan Email disini untuk keperluan lupa password" wire:model.defer="postDataProfile.email">
        @error('postDataProfile.email')
            <x-ui.input-message>
                @slot('message')
                    {{ $message }}
                @endslot
            </x-ui.input-message>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="label mb-1">
            Role
        </label>
        <input type="text" disabled class="form-control capitalize @error('postDataProfile.role') invalid @enderror"
            placeholder="Role" wire:model.defer="postDataProfile.role">
        @error('postDataProfile.role')
            <x-ui.input-message>
                @slot('message')
                    {{ $message }}
                @endslot
            </x-ui.input-message>
        @enderror
    </div>
    <div class="mb-3">
        <label for="" class="label mb-1">
            No Whatsapp
        </label>
        <input type="number" class="form-control @error('postDataProfile.no_whatsapp') invalid @enderror"
            placeholder="Masukan No Whatsapp disini" wire:model.defer="postDataProfile.no_whatsapp">
        @error('postDataProfile.no_whatsapp')
            <x-ui.input-message>
                @slot('message')
                    {{ $message }}
                @endslot
            </x-ui.input-message>
        @enderror
    </div>
</div>
