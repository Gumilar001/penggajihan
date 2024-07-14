<div>
    <div class="bg-white shadow-sm rounded-lg w-full p-[10px] mb-4">
        <div class="flex items-center gap-4 pb-3 overflow-auto">
            @foreach ($company as $comp)
                <div wire:click='setCompany({{ $comp->company['id'] }})'
                    class="item-company whitespace-nowrap rounded-[20px] py-3 px-4 cursor-pointer flex items-center justify-center gap-2 text-sm {{ $selectedCompanyId == $comp->company['id'] ? 'bg-secondary-10 text-secondary-100 font-semibold' : 'bg-neutral-20 text-neutral-80 hover:bg-neutral-30 font-medium' }}">
                    <img src="{{ asset($comp->company['logo']) }}" alt="" class="object-contain max-w-[2rem] w-auto img-tab-company">
                    <div class="mr-2">
                        {{ $comp->company['name'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex items-stretch gap-4 mb-4">
        <div class="bg-white rounded-[10px] px-5 py-4 flex flex-1 flex-col">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-6 h-6 rounded-lg bg-primary-50">
                    {!! file_get_contents('assets/icons/outline-folder.svg') !!}
                </div>
                <div class="text-sm text-neutral-70">
                    Total Permintaan Barang
                </div>
            </div>
            <div class="text-3xl font-semibold !leading-10 mt-auto">
                {{ $totalbarang }}
            </div>
        </div>
        <div class="bg-white rounded-[10px] px-5 py-4 flex flex-1 flex-col">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-6 h-6 rounded-lg bg-warning-40">
                    {!! file_get_contents('assets/icons/outline-refresh.svg') !!}
                </div>
                <div class="text-sm text-neutral-70">
                    Permintaan Barang Sedang diproses
                </div>
            </div>
            <div class="text-3xl font-semibold !leading-10 mt-auto">
                {{ $prosesbarang }}
            </div>
        </div>
        <div class="bg-white rounded-[10px] px-5 py-4 flex flex-1 flex-col">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-6 h-6 rounded-lg bg-secondary-60">
                    {!! file_get_contents('assets/icons/outline-check-circle-white.svg') !!}
                </div>
                <div class="text-sm text-neutral-70">
                    Permintaan Barang Selesai
                </div>
            </div>
            <div class="text-3xl font-semibold !leading-10 mt-auto">
                {{ $selesaiBarang }}
            </div>
        </div>
    </div>
    <div class="bg-white shadow-sm rounded-lg w-full p-[10px] mb-4">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No Permintaan</th>
                        <th>Tanggal</th>
                        <th class="text-center">Proyek</th>
                        {{-- <th class="text-center whitespace-nowrap">No Slip</th> --}}
                        <th class="text-right">Total</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($dataPermintaanBarang) == 0)
                        <tr>
                            <td colspan="7">
                                <x-ui.empty-data message="Tidak Ada Data" />
                            </td>
                        </tr>
                    @else
                        @foreach ($dataPermintaanBarang as $key => $item)
                            <tr>
                                <td>
                                    <span class="font-semibold">
                                        {{ $item['kode_permintaan'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="whitespace-nowrap">
                                        {{ $item['tanggal'] }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="min-w-[8rem]">
                                        @if (isset($item->proyek))
                                            {{ $item->proyek['nama_proyek'] }}
                                        @else
                                            Kantor
                                        @endif
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="whitespace-nowrap">
                                        {{ getCurrencySymbol($item->mata_uang) }}
                                        {{ currency_IDR($item->detailpermintaan_barang->pluck('subtotal')->sum()) }}
                                    </div>
                                </td>
                                <td>
                                    @if ($item->is_urgent == 1)
                                        <div class="my-badge my-badge-success">
                                            {!! file_get_contents('assets/icons/badge-check.svg') !!}
                                            Telah Disetujui
                                        </div>
                                    @elseif ($item->is_approve_menyetujui == 1 && $item->is_approve_mengetahui == 1)
                                        <div class="my-badge my-badge-success">
                                            {!! file_get_contents('assets/icons/badge-check.svg') !!}
                                            Telah Disetujui
                                        </div>
                                    @else
                                        <div class="text-white my-badge bg-orange-1">
                                            {!! file_get_contents('assets/icons/outline-clock.svg') !!}
                                            <div class="text-ellipsis">
                                                @foreach ($item->status as $key => $menyetujui)
                                                    {{$menyetujui->user->name}}
                                                    @if ($key != count($item->status)-1)
                                                        ,
                                                    @endif
                                                @endforeach
                                                (Menyetujui)
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center justify-start">
                                        <div class="flex items-center justify-start gap-[5px]">
                                            @if ($item->is_approve_menyetujui == 1 && $item->is_approve_mengetahui == 1)
                                                <a href="/permintaan-barang/cetak/{{ $item->id }}" target="_blank"
                                                    class="mx-auto my-btn-action-table bg-blue-1"
                                                    data-bs-toggle="tooltip" title="Print Permintaan Barang">
                                                    {!! file_get_contents('assets/icons/document-print.svg') !!}
                                                </a>
                                            @else
                                                <button wire:click='edit({{ $item->id }})'
                                                    class="mx-auto my-btn-action-table my-btn-warning"
                                                    data-bs-toggle="tooltip" title="Edit Permintaan Barang">
                                                    {!! file_get_contents('assets/icons/outline-pencil-alt.svg') !!}
                                                </button>
                                                <div class="relative dropdown">
                                                    <div class="flex items-center gap-2 cursor-pointer w-[35px] h-[35px] justify-center"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        {!! file_get_contents('assets/icons/outline-dots-vertical.svg') !!}
                                                    </div>
                                                    <ul aria-labelledby="dropdownMenuButton1"
                                                        class="absolute z-50 hidden float-left m-0 mt-1 overflow-hidden text-base text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu min-w-max bg-clip-padding">
                                                        <li>
                                                            <button wire:click="detail({{ $item->id }})"
                                                                class="group dropdown-item text-sm py-2 px-4 font-normal w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-secondary-50 hover:text-white active:!bg-secondary-50 active:!text-white focus:!bg-secondary-50 focus:!text-white flex items-center gap-2 rounded-t">
                                                                <div
                                                                    class="group-hover:[&>svg>path]:stroke-white group-active:[&>svg>path]:stroke-white [&>svg>path]:stroke-neutral-90">
                                                                    {!! file_get_contents('assets/icons/eye.svg') !!}
                                                                </div>
                                                                Detail
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button wire:click='showModalHistory({{ $item->id }})'
                                                                class="group/item dropdown-item text-sm py-2 px-4 font-normal w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-secondary-50 hover:text-white active:!bg-secondary-50 active:!text-white focus:!bg-secondary-50 focus:!text-white flex items-center gap-2">
                                                                <div
                                                                    class="group-hover/item:[&>svg>path]:fill-white group-active/item:[&>svg>path]:fill-white [&>svg>path]:fill-neutral-90">
                                                                    {!! file_get_contents('assets/icons/outline-history.svg') !!}
                                                                </div>
                                                                History
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div id="triggerModalHistory" data-bs-target="#modalHistoryPermintaanBarang" data-bs-toggle="modal"></div>

    @include('components.modal.modal-history-permintaan-barang')
</div>


@push('script')
    <script>
        $(document).ready(function(e) {

            var index = 0;
            $(".item-company").each(function(e) {
                if (index == 0) {
                    $(this).click()
                }
                index++
            });
            Livewire.on('show-modal-history', () => {
                $("#triggerModalHistory").click();
            });
        })
    </script>
@endpush
