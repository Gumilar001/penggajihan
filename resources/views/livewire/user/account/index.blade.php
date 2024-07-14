<div>
    <div class="bg-white shadow-sm rounded-3xl w-full p-[30px] mb-6">
        <div class="flex items-center gap-4">
            <div class="[&>svg>path]:fill-secondary-100">
                {!! file_get_contents('assets/icons/integrations.svg') !!}
            </div>
            <div class="font-bold title-page text-black-80">
                User Account
            </div>
        </div>
        <div class="mb-[22px] mt-10"></div>
        <div
            class="flex mb-5 gap-3 items-start sm:items-center flex-wrap min-[400px]:!flex-nowrap flex-col-reverse min-[400px]:flex-row">
            <div class="flex-1 w-full min-[400px]:!w-1/2">
                <div class="relative">
                    <input type="text" placeholder="Cari Nama User" wire:model="search"
                        class="px-4 py-3 pr-10 w-full text-xs border-black-20 rounded-lg placeholder:text-black-80 focus:ring-0 focus:border-secondary-60 min-w-[200px]">
                    <div class="absolute h-[41.6px] top-0 right-4 flex items-center justify-center cursor-pointer">
                        {!! file_get_contents('assets/icons/search.svg') !!}
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-1">
                @can('create users')
                    <button class="my-btn my-btn-secondary" wire:click="showModal('add')">
                        Tambah
                    </button>
                @endcan
            </div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="w-[30px] text-center">No</th>
                        <th class="whitespace-nowrap">Nama Lengkap</th>
                        <th>Username</th>
                        <th class="w-40">Status</th>
                        <th>Role</th>
                        {{-- @canany(['edit users', 'delete users']) --}}
                        <th class="text-center w-28">Aksi</th>
                        {{-- @endcanany --}}
                    </tr>
                </thead>
                <tbody>
                    @if (count($user) > 0)
                        @foreach ($user as $key => $item)
                            <tr>
                                <td class="text-center">
                                    <div class="mt-[5px]">
                                        {{ $user->firstItem() + $key }}
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-[5px]">
                                        {{ $item->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-[5px]">
                                        {{ $item->username }}
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-[5px]">
                                        <span class="capitalize">
                                            @if (count($item->roles) > 0)
                                                {{ $item->roles[0]['name'] }}
                                            @else
                                                <span class="italic text-black-60">
                                                    Role belum diatur
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <div class="flex flex-col items-start gap-[5px]">
                                            @if ($item->is_active)
                                                <div
                                                    class="inline-block px-3 py-1 text-xs text-center border rounded-lg border-secondary-60 text-secondary-60">
                                                    Aktif
                                                </div>
                                            @else
                                                <div
                                                    class="inline-block px-3 py-1 text-xs text-center border rounded-lg border-danger-60 text-danger-60">
                                                    <div class="text-ellipsis">
                                                        Tidak Aktif
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                {{-- @canany(['edit users', 'delete users']) --}}
                                <td class="text-center">
                                    <div class="flex justify-center gap-1">
                                        {{-- @can('edit users') --}}
                                        <button wire:click='showModal("edit", {{ $item->id }})'
                                            class="my-btn-action-table my-btn-warning" data-bs-toggle="tooltip"
                                            title="Edit">
                                            {!! file_get_contents('assets/icons/outline-pencil-alt.svg') !!}
                                        </button>
                                        {{-- @endcan --}}
                                        @can('delete users')
                                            <button wire:click="deleteAccount({{ $item->id }})"
                                                class="my-btn-action-table my-btn-danger" data-bs-toggle="tooltip"
                                                title="Hapus">
                                                {!! file_get_contents('assets/icons/outline-trash.svg') !!}
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                                {{-- @endcanany --}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <x-ui.empty-data message="Tidak Ada Data" />
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="m-3 mt-6">
            <nav class="flex items-center justify-end">
                <ul class="pagination">
                    {{ $user->links() }}
                </ul>
            </nav>
        </div>
    </div>
    <div data-bs-toggle="modal" data-bs-target="#modalActionAccount" class="hidden" id="triggerAddAccount"></div>
    <div data-bs-toggle="modal" data-bs-target="#modalImportPangkat" class="hidden" id="triggerImportPangkat"></div>

    @include('components.modal.modal-action-account')
    @include('components.modal.import.modal-import-pangkat')

</div>

@push('script')
    <script>
        $(document).ready(function() {
            window.livewire.on('show-modal-import', () => {
                $("#triggerImportPangkat").click();
            });
            window.livewire.on('done-import-pangkat', (params) => {
                $(".modal .btn-cancel").click()
            });
            $('.btn-filter').click(function() {
                setTimeout(() => {
                    $('.menu-sub-dropdown').addClass('show')
                    $('.menu-sub-dropdown').attr('aria-expanded', true)
                }, 300);
            })

            $('.menu-sub-dropdown').on("click", function(e) {
                $(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
            });

            $('.select2-role').on('select2:close', function(e) {
                try {
                    setTimeout(() => {
                        renderSelect2()
                    }, 200);
                } catch (error) {

                }
            });

            window.livewire.on('show-modal', (role_id) => {
                $("#triggerAddAccount").click();
                renderSelect2()

                $(".select2-role").val('').trigger('change')

                if (role_id != null) {
                    $(".select2-role").val(role_id).trigger('change');
                }
            });

            window.livewire.on('close-modal-action-account', () => {
                $("#modalActionAccount .btn-cancel").click();
            });

            function renderSelect2() {
                $('.select2-role').select2({
                    dropdownParent: $('#modalActionAccount')
                });

                $('.select2-role').on('select2:select', function(e) {
                    var data = e.params.data;
                    console.log(data.id)
                    livewire.emit('setPostRole', 'role_id', data.id)
                });
            }
        });
    </script>
@endpush
