<div>
    <div class="bg-white shadow-sm rounded-3xl w-full p-[30px]">
        <div class="flex items-center gap-4 mb-7">
            <a href="/user/role" class="[&>svg>path]:fill-secondary-100">
                {!! file_get_contents('assets/icons/back.svg') !!}
            </a>
            <div class="flex flex-col">
                <div class="title-page font-bold text-black-80">
                    Tambah Role
                </div>
                <div class="text-sm text-neutral-60">
                    Halaman ini digunakan untuk menambahkan Role
                </div>
            </div>
        </div>

        <div class="flex items-start gap-[18px] mb-5 flex-wrap sm:flex-nowrap">
            <div class="flex-1 w-full sm:!w-1/2">
                <div>
                    <label for="" class="label-required mb-1">
                        Nama Role
                    </label>
                    <input type="text" class="form-control min-w-[200px] @error('postData.role_name') invalid @enderror"
                        placeholder="Example : Keuangan" wire:model.defer="postData.role_name">
                    @error('postData.role_name')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>

            <div class="flex-1 w-full sm:!w-1/2">
                <div>
                    <label for="" class="label-required">
                        Pilih Akses
                    </label>
                    <div wire:ignore class="w-full">
                        <select class="select2-role self-stretch form-control min-w-[200px] @error('accessMenu') invalid @enderror"
                            name="access" wire:model.defer='accessMenu' wire:change='changeAccess()'>
                            <option class="text-black-40" value="" selected hidden disabled>Pilih Akses</option>
                            <option value="all">Akses ke Semua Menu</option>
                            <option value="custom">Akses Menu Custom</option>
                        </select>
                    </div>
                    @error('accessMenu')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>

        <div>
            <div
                class="bg-secondary-70 text-white font-inter text-sm flex items-center rounded px-[10px] py-[5px] mb-3">
                <div class="flex-1 whitespace-nowrap">Nama Akses</div>
                <div class="text-center w-20 md:w-52">Grant Akses</div>
            </div>

            {{-- overflow-auto max-h-[calc(100vh-560px)] --}}
            <div class="list-permissions-add">
                @foreach ($listPermissions as $index => $item)
                    <div class="accordion mb-3" id="accordion{{ $index }}">
                        <div class="accordion-item bg-white">
                            <h2 class="accordion-header mb-0 relative" id="headingAccordion{{ $index }}">
                                <button
                                    class="accordion-button relative flex items-center w-full py-4 px-[10px] text-base text-left !bg-neutral-20 !text-black-100 border-0 transition focus:outline-none after:hidden !shadow-none !rounded"
                                    type="button">
                                    <div class="flex-1" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne{{ $index }}" aria-expanded="true"
                                        aria-controls="collapseOne{{ $index }}">
                                        <div class="flex items-center gap-3">
                                            <div class="[&>svg>path]:fill-black-80">
                                                {!! file_get_contents('assets/icons/' . $item->icon) !!}
                                            </div>
                                            <span class="text-black-80">
                                                {{ $item->permission_title }}
                                            </span>
                                        </div>
                                    </div>
                                </button>
                                <div class="absolute w-20 md:w-52 flex justify-center items-center right-[10px] top-0 h-[56px]">
                                    <input type="checkbox"
                                        class="cursor-pointer relative z-10 checkbox-permission-parent"
                                        parent-id="{{ $item->id }}" id="cbx{{ $index }}">
                                </div>
                            </h2>
                            <div id="collapseOne{{ $index }}" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne{{ $index }}">
                                <div class="accordion-body font-inter text-sm">
                                    @foreach ($item->permission as $indexChild => $itemChild)
                                        <div class="flex items-center p-[10px] w-">
                                            <div class="flex-1 ml-1 capitalize text-[13px]">
                                                @if ($item->permission_title == 'Dashboard')
                                                    @if (!str_contains($itemChild->name, 'sub_feature'))
                                                        <b>{{ transText($itemChild->name) }}</b>
                                                    @else
                                                        {{ transText(str_replace('sub_feature', '', $itemChild->name)) }}
                                                    @endif
                                                @else
                                                    {{ transText($itemChild->name) }}
                                                @endif
                                            </div>
                                            <div class="w-20 md:w-52 flex justify-center items-center">
                                                @if (str_contains($itemChild->name, 'sub_feature'))
                                                    <input type="radio" class="cursor-pointer radio-permission-child"
                                                        name="radio_{{ $index }}"
                                                        data-id="{{ $itemChild->id }}"
                                                        data-parent="{{ $item->id }}"
                                                        id="radio{{ $index }}_{{ $indexChild }}">
                                                @else
                                                    <input type="checkbox"
                                                        class="cursor-pointer checkbox-permission-child"
                                                        data-id="{{ $itemChild->id }}"
                                                        data-parent="{{ $item->id }}"
                                                        id="cbx{{ $index }}_{{ $indexChild }}">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="sm:mb-3 mb-6 mt-4">
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

            <div class="flex items-center gap-3 justify-end">
                <button wire:click="redirectTo('/user/role')" class="my-btn my-btn-outline-secondary min-w-[unset] sm:min-w-[190px]">
                    Batal
                </button>
                <button wire:click='store()' class="my-btn my-btn-secondary min-w-[unset] sm:min-w-[190px]">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {

            function toggleCheckedPermission(id, isChecked, parentId = null) {

                if (parentId) {
                    var listId = [];
                    $('[data-parent="' + parentId + '"]').each(function(e) {
                        var type = $(this)[0].type
                        if (type == 'radio') {
                            var id = parseInt($(this).attr('data-id'))
                            listId.push(id)
                        }
                    })
                    console.log(listId)
                    livewire.emit('removeAllFromId', listId);
                }

                if (isChecked) livewire.emit('addPermissionId', id);
                else livewire.emit('removePermissionId', id);
            }

            $(".checkbox-permission-child").click(function() {
                var checked = $(this).prop('checked')
                var id = $(this).attr('data-id')
                toggleCheckedPermission(id, checked)

                if (!checked) {
                    var parentId = $(this).attr('data-parent')
                    var listId = [];
                    $('[data-parent="' + parentId + '"]').each(function(e) {
                        var type = $(this)[0].type
                        if (type == 'radio') {
                            var id = parseInt($(this).attr('data-id'))
                            listId.push(id)
                            $(this).prop('checked', false)
                        }
                    })

                    console.log(listId)
                    livewire.emit('removeAllFromId', listId);
                }
            })

            $(".radio-permission-child").click(function() {
                var checked = $(this).prop('checked')
                var id = $(this).attr('data-id')
                var parentId = $(this).attr('data-parent')
                toggleCheckedPermission(id, checked, parentId)

                $('[parent-id="' + parentId + '"]').prop('checked', true);
                $('[type="checkbox"][data-parent="' + parentId + '"]').prop('checked', true);
            })

            $(".checkbox-permission-parent").click(function() {
                var checked = $(this).prop('checked')
                var id = $(this).attr('parent-id')

                $(`[data-parent="${id}"]`).each(function(e) {
                    var idChild = $(this).attr('data-id')
                    $(this).prop('checked', checked)
                    toggleCheckedPermission(idChild, checked)
                })
            })



            window.livewire.on('change-access', (val) => {
                if (val == 'all') {
                    $('.list-permissions-add input[type="checkbox"]').each(function(e) {
                        var id = $(this).attr('data-id')
                        $(this).prop('checked', true);
                        toggleCheckedPermission(id, true)
                    })
                } else {
                    $('.list-permissions-add input[type="checkbox"]').each(function(e) {
                        var id = $(this).attr('data-id')
                        $(this).prop('checked', false);
                        toggleCheckedPermission(id, false)
                    })
                }
            });
        });
    </script>
@endpush
