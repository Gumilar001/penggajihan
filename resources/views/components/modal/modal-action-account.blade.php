<x-ui.modal-template modalID="modalActionAccount">
    <x-slot name="header">
        <h5 class="text-base font-bold leading-normal text-gray-800" id="modalActionAccount">
            {{ $typeModalActionAccount == 'add' ? 'Tambah' : 'Edit' }} User
        </h5>
    </x-slot>
    <x-slot name="body">
        <form wire:submit.prevent="store">
            <div class="mb-3">
                <label for="" class="label-required">
                    Nama Lengkap
                </label>
                <input type="text" class="form-control @error('postData.name') invalid @enderror"
                    placeholder="Example : Ardian Agustin" wire:model.defer="postData.name">
                @error('postData.name')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="label-required">
                    Username
                </label>
                <input type="text" class="form-control @error('postData.username') invalid @enderror"
                    placeholder="Example : ardianngustin" wire:model.defer="postData.username">
                @error('postData.username')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="{{ $typeModalActionAccount == 'add' ? 'label-required' : 'label' }}">
                    Password
                </label>
                <div class="relative">
                    <div class="relative">
                        <input type="password" id="password"
                            class="form-control @error('postData.password') invalid @enderror"
                            placeholder="Masukan Password disini.." wire:model.defer="postData.password">
                        @error('postData.password')
                            <x-ui.input-message>
                                @slot('message')
                                    {{ $message }}
                                @endslot
                            </x-ui.input-message>
                        @enderror

                        <div class="absolute h-[39.6px] flex items-center justify-center right-4 top-0">
                            <i
                                class="cursor-pointer fas fa-eye-slash text-primary80 toggle-password text-neutral-90 fs-12"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="" class="{{ $typeModalActionAccount == 'add' ? 'label-required' : 'label' }}">
                    Konfirmasi Password
                </label>
                <div class="relative">
                    <input type="password" id="password"
                        class="form-control @error('postData.password_confirmation') invalid @enderror"
                        placeholder="Masukan Password disini.." wire:model.defer="postData.password_confirmation">
                    @error('postData.password_confirmation')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror

                    <div class="absolute h-[39.6px] flex items-center justify-center right-4 top-0">
                        <i
                            class="cursor-pointer fas fa-eye-slash text-primary80 toggle-password text-neutral-90 fs-12"></i>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="" class="label-required">
                    Role
                </label>
                <div wire:ignore class="w-full">
                    <select class="self-stretch select2-role form-control" name="roles">
                        <option class="text-black-40" value="" selected hidden disabled>Pilih Role</option>
                        @foreach ($roles as $item)
                            <option value="{{$item['id']}}">
                                {{ $item['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('postData.role_id')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            </div>
            
            <div class="mb-3">
                <div class="flex">
                    <label for="" class="label-required">
                        Status Aktif
                    </label>
                </div>
                <div class="bg-tab-pane p-[5px] inline-flex rounded-lg gap-[10px] mt-1">
                    <div wire:click="setStatus(true)"
                        class="px-4 py-2 rounded-lg transition duration-150 cursor-pointer text-sm {{ $is_active == true ? 'bg-secondary-60 text-white' : 'text-neutral-70 hover:bg-neutral-20/40' }}">
                        Aktif
                    </div>
                    <div wire:click="setStatus(false)"
                        class="px-4 py-2 rounded-lg transition duration-150 cursor-pointer text-sm {{ $is_active == false ? 'bg-secondary-60 text-white' : 'text-neutral-70 hover:bg-neutral-20/40' }}">
                        Tidak Aktif
                    </div>
                </div>
            </div>
        </form>
    </x-slot>
    <x-slot name="footer">
        <button class="flex-1 my-btn my-btn-outline-secondary btn-cancel" data-bs-dismiss="modal" type="button">
            Batal
        </button>
        <button class="flex-1 my-btn my-btn-secondary" type="submit" wire:click='store()'>
            Simpan
        </button>
    </x-slot>
</x-ui.modal-template>

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#cbx_all_company").click(function (e) {
                var checked = $(this).prop('checked')

                livewire.emit('toggleAllCompany', checked);
            })

            $(".toggle-password").click(function() {
                var input = $(this).parent().parent().find("input")
                var type = input.attr('type')
                if (type == "password") {
                    input.attr('type', "text");
                    $(this).addClass("fa-eye").removeClass("fa-eye-slash");
                } else {
                    input.attr('type', "password");
                    $(this).removeClass("fa-eye").addClass("fa-eye-slash");
                }
            });
        });
    </script>
@endpush
