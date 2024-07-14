<div>
    <div class="bg-white shadow-sm rounded-3xl w-full p-[30px] min-h-[300px]">
        <div class="flex items-center gap-4">
            <div class="[&>svg>path]:fill-secondary-100">
                {!! file_get_contents('assets/icons/product.svg') !!}
            </div>
            <div class="font-bold title-page text-black-80">
                Data Penggajihan Personel PNS
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
                <button wire:click="addPenggajihan('add')" class="my-btn my-btn-secondary w-full min-[400px]:!w-auto">
                    Tambah Penggajihan
                </button>
            </div>
            {{-- @endcan --}}
        </div>

        <div class="mt-5 table-responsive"> 
            <table>
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Pns</th>
                        <th class="text-center">Bulan Penggajihan</th>
                        <th class="text-center">personel Pangkat</th>
                        <th class="text-center">Penghasilan Kotor</th>
                        <th class="text-center">Jumlah Potongan</th>
                        <th class="text-center">Gajih Bersih</th>
                        {{-- @canany(['edit master pns', 'delete master pns']) --}}
                        <th class="text-center col-action">Aksi</th>
                        {{-- @endcanany --}}
                    </tr>
                </thead>
                <tbody>
                    @if (count($data) > 0)
                        @foreach ($data as $key => $item)
                            <tr>
                                <td class="text-center w-[50px]">
                                    <div class="mt-[5px]">
                                        {{ $data->firstItem() + $key }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="mt-[5px]">
                                        {{ $item->PersonelId->nama_pns }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="mt-[5px]">
                                        {{ Carbon\Carbon::createFromFormat('m', $item->bulan_penggajihan)->format('F') }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="mt-[5px]">
                                        {{ $item->PersonelId->pangkatId->nama_pangkat }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="mt-[5px]">
                                        Rp {{ currency_IDR($item->penghasilan_kotor) }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="mt-[5px]">
                                        Rp {{ currency_IDR($item->jumlah_potongan) }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="mt-[5px]">
                                        Rp {{ currency_IDR($item->penghasilan_bersih) }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="flex justify-center gap-1">
                                        {{-- @can('edit master deskripsi') --}}
                                        <a href="/penggajihan-pns/cetak/{{ $item->id }}" target="_blank"
                                            class="my-btn-action-table bg-blue-1" data-bs-toggle="tooltip"
                                            title="Print Document">
                                            {!! file_get_contents('assets/icons/document-print.svg') !!}
                                        </a>
                                        <button wire:click="editPenggajihan({{ $item->id }})"
                                            class="my-btn-action-table my-btn-warning" title="Edit Item">
                                            {!! file_get_contents('assets/icons/outline-pencil-alt.svg') !!}
                                        </button>
                                        {{-- @endcan --}}
                                        {{-- @can('delete master deskripsi') --}}
                                        <button wire:click="deletePenggajihan({{ $item->id }})"
                                            class="my-btn-action-table my-btn-danger" data-bs-toggle="tooltip"
                                            title="Hapus Item">
                                            {!! file_get_contents('assets/icons/outline-trash.svg') !!}
                                        </button>
                                       
                                        {{-- @endcan --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">
                                <x-ui.empty-data message="Tidak Ada Data" />
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="float-right m-3 mt-6">
                <nav class="flex items-center">
                    <ul class="pagination">
                        {{ $data->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div data-bs-toggle="modal" data-bs-target="#modalPenggajihanPns" class="hidden" id="triggerAddPenggajihanPns">
    </div>
    @include('components.modal.penggajihan.modal-penggajihan-pns')
</div>

@push('script')
    <script>
        $(document).ready(function() {
            window.livewire.on('show-modal-penggajihan-pns', (data, type) => {
                $("#triggerAddPenggajihanPns").click();
                $(".select2-personel").val('').trigger('change')

                renderSelect2()
                $(".select2-personel").val('').trigger('change')
                if (data) {
                    $(".select2-personel").val(data['id_personel']).trigger('change');
                }
            });

            window.livewire.on('close-modal-penggajihan-pns', () => {
                $("#modalPenggajihanPns .btn-cancel").click()
                console.log($("#modalPenggajihanPns .btn-cancel").click())
            });
            $('.select2-personel').on('select2:close', function(e) {
                try {
                    setTimeout(() => {
                        renderSelect2()
                    }, 200);
                } catch (error) {

                }
            });

            function renderSelect2() {
                $('.select2-personel').select2({
                    dropdownParent: $('#modalPenggajihanPns')
                });

                $('.select2-personel').on('select2:select', function(e) {
                    var data = e.params.data;
                    console.log(data.id)
                    livewire.emit('setPostPersonel', 'id_personel', data.id)
                });
                $('.select2-personel').on('select2:select', function(e) {
                    var data = e.params.data;
                    console.log(data.id)
                    livewire.emit('selectPersonel', 'id_personel', data.id)
                });
            }
        })
    </script>
@endpush
