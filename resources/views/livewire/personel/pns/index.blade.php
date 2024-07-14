<div>
    <div class="bg-white shadow-sm rounded-3xl w-full p-[30px] min-h-[300px]">
        <div class="flex items-center gap-4">
            <div class="[&>svg>path]:fill-secondary-100">
                {!! file_get_contents('assets/icons/product.svg') !!}
            </div>
            <div class="font-bold title-page text-black-80">
                Master Data personel PNS
            </div>
        </div>
        <div
            class="flex mb-5 gap-3 mt-10 items-center flex-wrap min-[400px]:!flex-nowrap flex-col-reverse min-[400px]:flex-row">
            <div class="flex-1 w-full min-[400px]:!w-1/2">
                <div class="relative">
                    <input type="text" placeholder="Cari Nama PNS" wire:model="search"
                        class="px-4 py-3 pr-10 w-full text-xs border-black-20 rounded-lg placeholder:text-black-80 focus:ring-0 focus:border-secondary-60 min-w-[200px]">
                    <div class="absolute h-[46px] top-0 right-4 flex items-center justify-center cursor-pointer">
                        {!! file_get_contents('assets/icons/search.svg') !!}
                    </div>
                </div>
            </div>
            {{-- @can('create master pns') --}}
            <div class="flex items-center gap-2 sm:flex-wrap w-full min-[400px]:!w-auto">
                <button wire:click="addPersonelPns('add')" class="my-btn my-btn-secondary w-full min-[400px]:!w-auto">
                    Tambah Personel
                </button>
                <button wire:click='importPersonelPns()' class="my-btn my-btn-outline-secondary hidden sm:!block">
                    Import Personel
                </button>
            </div>
            {{-- @endcan --}}
        </div>

        <div class="mt-5 table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nrp</th>
                        <th class="text-center">Npwp</th>
                        <th>Nama Pns</th>
                        <th class="text-center">Status Menikah</th>
                        <th class="text-center">Golongan Pangkat</th>
                        {{-- @canany(['edit master pns', 'delete master pns']) --}}
                        <th class="text-center col-action">Aksi</th>
                        {{-- @endcanany --}}
                    </tr>
                </thead>
                <tbody>
                    @if (count($personel) > 0)
                        @foreach ($personel as $key => $item)
                            <tr>
                                <td class="text-center w-[50px]">
                                    <div class="mt-[5px]">
                                        {{ $personel->firstItem() + $key }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="mt-[5px]">
                                        {{ $item->nrp??'-' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div>
                                        {{ $item->npwp }}
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-[5px]">
                                        {{ $item->nama_pns }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="mt-[5px]">
                                        {{ $item->status_menikah == 1 ?  'Sudah Menikah' : 'Belum Menikah' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="mt-[5px]">
                                        {{ $item->pangkatId['nama_pangkat'] }}
                                    </div>
                                </td>
                                {{-- @canany(['edit master deskripsi', 'delete master deskripsi']) --}}
                                    <td class="text-center">
                                        <div class="flex justify-center gap-1">
                                            {{-- @can('edit master deskripsi') --}}
                                                <button wire:click="editPns({{ $item->id }})"
                                                    class="my-btn-action-table my-btn-warning" title="Edit Item">
                                                    {!! file_get_contents('assets/icons/outline-pencil-alt.svg') !!}
                                                </button>
                                            {{-- @endcan --}}
                                            {{-- @can('delete master deskripsi') --}}
                                                <button wire:click="deletePns({{ $item->id }})"
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
                            <td colspan="5">
                                <x-ui.empty-data message="Tidak Ada Data" />
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
            <div class="float-right m-3 mt-6">
                <nav class="flex items-center">
                    <ul class="pagination">
                        {{ $personel->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div data-bs-toggle="modal" data-bs-target="#modalActionPns" class="hidden" id="triggerAddPns"></div>
    <div data-bs-toggle="modal" data-bs-target="#modalImportPersonelPns" class="hidden" id="triggerImportPersonelPns"></div>

    @include('components.modal.personel.modal-action-pns')
    @include('components.modal.import.modal-import-personel-pns')
</div>

@push('script')
    <script>
        $(document).ready(function() {
            window.livewire.on('done-import-pns', (params) => {
                $(".modal .btn-cancel").click()
            });
            window.livewire.on('show-modal-import-pns', () => {
                $("#triggerImportPersonelPns").click();
            });
            window.livewire.on('show-modal-pns', (data, type) => {
                $("#triggerAddPns").click();
                $(".select2-golongan").val('').trigger('change')

                renderSelect2()
                renderCheckbox()
                $(".select2-golongan").val('').trigger('change')
                if (data) {
                    $(".select2-golongan").val(data['id_pangkat']).trigger('change');
                }
            });
           
            window.livewire.on('close-modal-action-pns', () => {
                $("#modalActionPns .btn-cancel").click()
            });
        })
        $('.select2-golongan').on('select2:close', function(e) {
            try {
                setTimeout(() => {
                    renderSelect2()
                }, 200);
            } catch (error) {

            }
        });

        function renderSelect2() {
            $('.select2-golongan').select2({
                dropdownParent: $('#modalActionPns')
            });

            $('.select2-golongan').on('select2:select', function(e) {
                var data = e.params.data;
                console.log(data.id)
                livewire.emit('setPostPangkat', 'id_pangkat', data.id)
            });
        }

        function select(){
            var value = $('#cbx1').prop("checked");
            console.log(value);
        }
        function renderCheckbox() {
            var status = @this.tampung
            console.log(status)
            if(status) {
                $('.wrapper-nama-rekening').prop("hidden", false)
            }else {
                $('.wrapper-nama-rekening').prop("hidden", true)
            }

            $('#cbx1').click(function(event) {
                var x = $(this).prop("checked");
                if (x) {
                    $('.wrapper-nama-rekening').prop("hidden", false)
                } else {
                    $('.wrapper-nama-rekening').prop("hidden", true)
                }
                livewire.emit('setStatusMenikah', x)
                console.log(x)
            });


        }
    </script>
@endpush
