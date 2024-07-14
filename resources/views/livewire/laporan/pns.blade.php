<div class="mb-4">
    <div class="bg-white shadow-sm rounded-3xl w-full p-[30px] min-h-[300px] mb-6">
        <div class="flex items-center gap-4 mb-5">
            <div class="[&>svg>path]:fill-secondary-100">
                {!! file_get_contents('assets/icons/statistic.svg') !!}
            </div>
            <div class="font-bold title-page text-black-80">
                Laporan Penggajihan PNS
            </div>
        </div>
        <div class="flex items-center gap-[10px]">
            <div class="flex-1">
                <div wire:ignore class="self-stretch">
                    <select class="self-stretch select2-pns-bulan" name="state">
                        <option class="text-black-40" value="" selected>Pilih Bulan Penggajihan
                        </option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
            </div>
        </div>

        @if ($generalFilter['bulan_pns_id'] != null)
            <div class="flex items-center gap-[10px] mt-3">
                <div class="w-full">
                    <div class="relative">
                        <input type="text" placeholder="Cari No Permintaan Barang / No PO / No Pembayaran"
                            wire:model="search"
                            class="px-4 py-3 pr-10 w-full text-xs border-black-20 rounded-lg placeholder:text-black-80 focus:ring-0 focus:border-secondary-60 min-w-[230px]">
                        <div class="absolute h-[41.6px] top-0 right-4 flex items-center justify-center cursor-pointer">
                            {!! file_get_contents('assets/icons/search.svg') !!}
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button wire:click="export()" class="text-white whitespace-nowrap my-btn bg-secondary-60">
                        Download Laporan
                    </button>
                </div>
            </div>

            <div class="table-responsive mt-7">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama PNS</th>
                            <th class="text-center">Bulan Penggajihan</th>
                            <th class="text-center">personel Pangkat</th>
                            <th class="text-center">Penghasilan Kotor</th>
                            <th class="text-center">Jumlah Potongan</th>
                            <th class="text-center">Gajih Bersih</th>
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
                                            {{ $item->bulan_penggajihan }}
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
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">
                                    <x-ui.empty-data message="Tidak Ada Data" />
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @else
        
            <div class="mt-20 min-h-[400px] flex items-center justify-center flex-col">
                <div class="animate-bounce">
                    <svg class="w-20 h-20 opacity-50" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3V21M8 7L12 3L8 7ZM12 3L16 7L12 3Z" stroke="#1059b1" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="mt-3 text-lg font-medium opacity-50 text-black-80">
                    Mohon isi dan lengkapi Form diatas
                </div>
            </div>
        @endif
    </div>
</div>

@push('script')
    <script>
        function renderSelectBulanPns() {
            $('.select2-pns-bulan').select2({
                placeholder: "Pilih Bulan Penggajihan PNS",
            });
            $('.select2-pns-bulan').on('change', function(e) {
                let data = $(this).val();
                console.log(data)
                Livewire.emit('setGeneralFilter', 'bulan_pns_id', data);
            });

        }
        renderSelectBulanPns();
    </script>
@endpush
