<div>
    <div class="bg-white shadow-sm rounded-3xl w-full p-[30px] min-h-[300px]">
        <div class="flex items-center gap-4">
            <div class="[&>svg>path]:fill-secondary-100">
                {!! file_get_contents('assets/icons/product.svg') !!}
            </div>
            <div class="font-bold title-page text-black-80">
                Master Data Pangkat
            </div>
        </div>
        <div
            class="flex mb-5 gap-3 mt-10 items-center flex-wrap min-[400px]:!flex-nowrap flex-col-reverse min-[400px]:flex-row">
            <div class="flex-1 w-full min-[400px]:!w-1/2">
                <div class="relative">
                    <input type="text" placeholder="Cari Nama Pangkat`" wire:model="search"
                        class="px-4 py-3 pr-10 w-full text-xs border-black-20 rounded-lg placeholder:text-black-80 focus:ring-0 focus:border-secondary-60 min-w-[200px]">
                    <div class="absolute h-[46px] top-0 right-4 flex items-center justify-center cursor-pointer">
                        {!! file_get_contents('assets/icons/search.svg') !!}
                    </div>
                </div>
            </div>
            {{-- @can('create master pns') --}}
            <div class="flex items-center gap-2 sm:flex-wrap w-full min-[400px]:!w-auto">
                <button wire:click="addPersonelPangkat('add')"
                    class="my-btn my-btn-secondary w-full min-[400px]:!w-auto">
                    Tambah Pangkat
                </button>
                <button wire:click='importPangkat()' class="my-btn my-btn-outline-secondary hidden sm:!block">
                    Import Pangkat
                </button>
            </div>
            {{-- @endcan --}}
        </div>

        <div class="mt-5 table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-left">Nama Pangkat</th>
                        <th class="text-left">Golongan</th>
                        <th>Jenis</th>
                        {{-- @canany(['edit master pns', 'delete master pns']) --}}
                        <th class="text-center col-action">Aksi</th>
                        {{-- @endcanany --}}
                    </tr>
                </thead>
                <tbody>
                    @if (count($pangkat) > 0)
                        @foreach ($pangkat as $key => $item)
                            <tr>
                                <td class="text-center w-[50px]">
                                    <div class="mt-[5px]">
                                        {{ $pangkat->firstItem() + $key }}
                                    </div>
                                </td>
                                <td class="text-left">
                                    <div class="mt-[5px]">
                                        {{ $item->nama_pangkat ?? '-' }}
                                    </div>
                                </td>
                                <td class="text-left">
                                    <div>
                                        Rp. {{ currency_IDR($item->golongan) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-[5px]">
                                        {{ $item->jenis }}
                                    </div>
                                </td>
                                {{-- @canany(['edit master deskripsi', 'delete master deskripsi']) --}}
                                <td class="text-center">
                                    <div class="flex justify-center gap-1">
                                        {{-- @can('edit master deskripsi') --}}
                                        <button wire:click="editPangkat({{ $item->id }})"
                                            class="my-btn-action-table my-btn-warning" title="Edit Item">
                                            {!! file_get_contents('assets/icons/outline-pencil-alt.svg') !!}
                                        </button>
                                        {{-- @endcan --}}
                                        {{-- @can('delete master deskripsi') --}}
                                        <button wire:click="deletePangkat({{ $item->id }})"
                                            class="my-btn-action-table my-btn-danger" data-bs-toggle="tooltip"
                                            title="Hapus Item">
                                            {!! file_get_contents('assets/icons/outline-trash.svg') !!}
                                        </button>
                                        {{-- @endcan --}}
                                    </div>
                                </td>
                                {{-- @endcanany --}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">
                                <x-ui.empty-data message="Tidak Ada Data" />
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
        <div class="m-3 mt-6">
            <nav class="flex items-center justify-end">
                <ul class="">
                    {{ $pangkat->links() }}
                </ul>
            </nav>
        </div>
    </div>
    <div data-bs-toggle="modal" data-bs-target="#modalActionPangkat" class="hidden" id="triggerAddPangkat"></div>
    <div data-bs-toggle="modal" data-bs-target="#modalImportPangkat" class="hidden" id="triggerImportPangkat"></div>

    @include('components.modal.personel.modal-action-pangkat')
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
            window.livewire.on('show-modal-pangkat', (data, type) => {
                $('#triggerAddPangkat').click();
                $(".select2-pangkat").val('').trigger('change')

                renderSelect2()
                $(".select2-pangkat").val('').trigger('change')
                if (data) {
                    $(".select2-pangkat").val(data['jenis']).trigger('change');
                }
            });
            window.livewire.on('close-modal-action-pangkat', () => {
                $('#modalActionPangkat .btn-cancel').click()
            });
            $('.select2-pangkat').on('select2:close', function(e) {
            try {
                setTimeout(() => {
                    renderSelect2()
                }, 200);
            } catch (error) {

            }
        });
        function renderSelect2() {
            $('.select2-pangkat').select2({
                dropdownParent: $('#modalActionPangkat')
            });

            $('.select2-pangkat').on('select2:select', function(e) {
                var data = e.params.data;
                console.log(data.id)
                livewire.emit('setPostPangkat', 'jenis', data.id)
            });
        }
        });
        
        
    </script>
@endpush
