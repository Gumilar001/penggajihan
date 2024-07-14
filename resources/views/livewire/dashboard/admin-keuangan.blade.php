<div>
    <div class="bg-white shadow-sm rounded-lg w-full p-[10px] mb-4">
        <div class="flex items-center gap-4">
            @foreach ($companykeuangan as $comp)
                <div wire:click='setCompany({{ $comp['company_id'] }})'
                    class="item-company whitespace-nowrap rounded-[20px] py-3 px-4 cursor-pointer flex items-center justify-center gap-2 text-sm {{ $selectedCompanyId == $comp['company_id'] ? 'bg-secondary-10 text-secondary-100 font-semibold' : 'bg-neutral-20 text-neutral-80 hover:bg-neutral-30 font-medium' }}">
                    <img src="{{ asset($comp->company['logo']) }}" alt=""
                        class="object-contain max-w-[2rem] w-auto img-tab-company">
                    <div class="mr-2">
                        {{ $comp->company['name'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex items-stretch gap-4 mb-4">
        <div class="bg-white rounded-[10px] px-5 py-4 flex-1">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-6 h-6 rounded-lg bg-primary-50">
                    {!! file_get_contents('assets/icons/outline-folder.svg') !!}
                </div>
                <div class="text-sm text-neutral-70">
                    Total Permintaan Pembayaran
                </div>
            </div>
            <div class="text-3xl font-semibold !leading-10 mt-3">
                {{ $totalpembayaran }}
            </div>
        </div>
        <div class="bg-white rounded-[10px] px-5 py-4 flex-1">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-6 h-6 rounded-lg bg-warning-40">
                    {!! file_get_contents('assets/icons/outline-refresh.svg') !!}
                </div>
                <div class="text-sm text-neutral-70">
                    Permintaan Pembayaran Sedang diproses
                </div>
            </div>
            <div class="text-3xl font-semibold !leading-10 mt-3">
                {{ $prosesPembayaran }}
            </div>
        </div>
        <div class="bg-white rounded-[10px] px-5 py-4 flex-1">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-6 h-6 rounded-lg bg-secondary-60">
                    {!! file_get_contents('assets/icons/outline-check-circle-white.svg') !!}
                </div>
                <div class="text-sm text-neutral-70">
                    Permintaan Pembayaran Selesai
                </div>
            </div>
            <div class="text-3xl font-semibold !leading-10 mt-3">
                {{ $selesaiPembayaran }}
            </div>
        </div>
    </div>
    <div class="bg-white shadow-sm rounded-lg w-full p-[10px] mb-4">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No Purchase Order</th>
                        <th>No Permintaan Pembayaran</th>
                        <th class="text-right">Nilai Pembayaran</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- {{json_encode($dataPermintaanPembayaran)}} --}}
                    @if (count($dataPermintaanPembayaran) == 0)
                        <tr>
                            <td colspan="5">
                                <x-ui.empty-data message="Tidak Ada Data" />
                            </td>
                        </tr>
                    @else
                        {{-- {{dd($dataPermintaanPembayaran)}} --}}
                        @foreach ($dataPermintaanPembayaran as $key => $item)
                            <tr>
                                <td>
                                    <span class="font-semibold">
                                        {{ $item->purchasing_order['no_purchase_order'] ?? 'Tidak menggunakan PO' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="font-semibold">
                                        {{ $item['no_permintaan_pembayaran'] }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    @if (isset($item->purchasing_order->permintaan_barang->mata_uang))
                                        {{ getCurrencySymbol($item->purchasing_order->permintaan_barang->mata_uang ?? 'IDR') }}
                                    @else
                                        {{ getCurrencySymbol($item->permintaan_barang->mata_uang ?? 'IDR') }}
                                    @endif

                                    {{ currency_IDR($item['total_pembayaran']) }}
                                </td>
                                <td class="align-top">
                                    @if (is_null($item->user_mengajukan))
                                        <div class="mt-[9px] max-w-[200px]">
                                            <span class="text-xs italic text-black-80">User belum diatur</span>
                                        </div>
                                    @else
                                        @if (
                                            $item->is_approve_pajak == 1 &&
                                                $item->is_approve_keuangan == 1 &&
                                                $item->is_approve_menyetujui_permintaan == 1 &&
                                                $item->is_approve_mengetahui_permintaan == 1)
                                            @if ($item->total_debit == $item->total_pembayaran)
                                                <div
                                                    class="bg-success-10 text-success-70 font-medium text-xs py-2 w-[160px] rounded-lg border-[1.5px] text-center border-success-70">
                                                    Lunas
                                                </div>
                                            @elseif($item->total_debit == 0)
                                                <div
                                                    class="bg-warning-10 text-warning-60 font-medium text-xs py-2 w-[160px] rounded-lg border-[1.5px] text-center border-warning-50">
                                                    Belum Lunas
                                                </div>
                                            @elseif($item->total_debit > $item->total_pembayaran)
                                                <div
                                                    class="bg-success-10 text-success-60 font-medium text-xs py-2 w-[160px] rounded-lg border-[1.5px] text-center border-success-50">
                                                    Lebih
                                                    {{ currency_IDR($item->total_debit - $item->total_pembayaran) }}
                                                </div>
                                            @else
                                                <div
                                                    class="bg-warning-10 text-warning-60 font-medium text-xs py-2 w-[160px] rounded-lg border-[1.5px] text-center border-warning-50">
                                                    Sisa
                                                    {{ currency_IDR($item->total_pembayaran - $item->total_debit) }}
                                                </div>
                                            @endif
                                            {{-- <div class="my-badge my-badge-success whitespace-nowrap">
                                                {!! file_get_contents('assets/icons/badge-check.svg') !!}
                                                Telah Disetujui
                                            </div> --}}
                                        @elseif(
                                            $item->is_approve_pajak == 0 &&
                                                $item->is_approve_keuangan == 0 &&
                                                !is_null($item->usermenyetujui) &&
                                                $item->is_approve_menyetujui_permintaan == 0 &&
                                                !is_null($item->is_approve_menyetujui_permintaan) &&
                                                !is_null($item->usermengetahui) &&
                                                $item->is_approve_mengetahui_permintaan == 0 &&
                                                !is_null($item->is_approve_mengetahui_permintaan))
                                            <div class="my-badge my-badge-danger">
                                                <span class="[&>svg>path]:stroke-white [&>svg]:w-4 [&>svg]:h-4">
                                                    {!! file_get_contents('assets/icons/outline-reject-sign.svg') !!}
                                                </span>
                                                Permintaan Tidak Disetujui
                                            </div>
                                        @else
                                            <div class="flex flex-col items-start gap-[5px]">
                                                {{-- approve pajak --}}
                                                @if (!is_numeric($item->is_approve_pajak))
                                                    @if ($item->user_pajak)
                                                        <div class="text-white my-badge bg-orange-1">
                                                            {!! file_get_contents('assets/icons/outline-clock.svg') !!}
                                                            {{ $item->user['name'] }} (Pajak)
                                                        </div>
                                                    @endif
                                                @endif
                                                {{-- end approve pajak --}}
                                                {{-- approve keuangan --}}
                                                @if (!is_numeric($item->is_approve_keuangan))
                                                    @if ($item->user_keuangan && $item->is_approve_pajak == 1)
                                                        <div
                                                            class="my-badge text-white bg-orange-1">
                                                            {!! file_get_contents('assets/icons/outline-clock.svg') !!}
                                                            {{ $item->userkeuangan['name'] }} (Keuangan)
                                                        </div>
                                                    @endif
                                                @endif
                                                {{-- end approve keuangan --}}

                                                {{-- approve menyetujui --}}
                                                @if ($item->usermenyetujui != null && ($item->is_approve_keuangan == 1 && is_null($item->is_approve_menyetujui_permintaan)))
                                                    <div
                                                        class="my-badge flex items-start gap-1 bg-orange-1 text-white">
                                                        <div class="mt-[1px]">
                                                            {!! file_get_contents('assets/icons/outline-clock.svg') !!}
                                                        </div>
                                                        <div class="text-ellipsis">
                                                            @foreach ($item->usermenyetujui as $key => $user_menyetujui)
                                                                {{ $user_menyetujui->user['name'] }}
                                                                @if ($key != count($item->usermenyetujui) - 1)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                            (Menyetujui)
                                                        </div>
                                                    </div>
                                                @endif
                                                {{-- end approve menyetujui --}}

                                                {{-- approve mengetahui --}}
                                                @if ($item->usermengetahui != null && ($item->is_approve_menyetujui_permintaan == 1 && is_null($item->is_approve_mengetahui_permintaan)))
                                                    <div
                                                        class="my-badge bg-orange-1 text-white">
                                                        {!! file_get_contents('assets/icons/outline-clock.svg') !!}
                                                        <div class="text-ellipsis">
                                                            @foreach ($item->usermengetahui as $key => $user_mengetahui)
                                                                {{ $user_mengetahui->user['name'] }}
                                                                @if ($key != count($item->usermenyetujui) - 1)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                            (Mengetahui)
                                                        </div>
                                                    </div>
                                                @endif
                                                {{-- end approve mengetahui --}}
                                            </div>
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center justify-center">
                                        <div class="flex items-center justify-start gap-[5px]">
                                            @if ($item->is_approve_menyetujui_permintaan == 1 && $item->is_approve_mengetahui_permintaan == 1)
                                                <a href="permintaan-pembayaran/cetak/{{ $item['id'] }}" target="_blank"
                                                    class="mx-auto my-btn-action-table bg-blue-1"
                                                    data-bs-toggle="tooltip" title="Print Permintaan Pembayaran">
                                                    {!! file_get_contents('assets/icons/document-print.svg') !!}
                                                </a>
                                            @else
                                                @if ($item->permintaan_barang_id != null)
                                                <button wire:click='editTanpaPO({{ $item->id }})'
                                                    class="mx-auto my-btn-action-table my-btn-danger"
                                                    data-bs-toggle="tooltip" title="Edit Permintaan Barang">
                                                    {!! file_get_contents('assets/icons/outline-pencil-alt.svg') !!}
                                                </button>
                                                @else
                                                <button wire:click='edit({{ $item->id }})'
                                                    class="mx-auto my-btn-action-table my-btn-warning"
                                                    data-bs-toggle="tooltip" title="Edit Permintaan Barang">
                                                    {!! file_get_contents('assets/icons/outline-pencil-alt.svg') !!}
                                                </button>
                                                @endif
                                                <div class="relative dropdown">
                                                    <div class="flex items-center gap-2 cursor-pointer w-[35px] h-[35px] justify-center"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        {!! file_get_contents('assets/icons/outline-dots-vertical.svg') !!}
                                                    </div>
                                                    <ul aria-labelledby="dropdownMenuButton1"
                                                        class="absolute z-50 hidden float-left m-0 mt-1 overflow-hidden text-base text-left list-none bg-white border-none rounded-lg shadow-lg dropdown-menu min-w-max bg-clip-padding">
                                                        <li>
                                                            <a href="permintaan-pembayaran/detail/{{ $item->purchasing_order->permintaan_barang_id ?? $item->permintaan_barang_id }}"
                                                                class="group dropdown-item text-sm py-2 px-4 font-normal w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-secondary-50 hover:text-white active:!bg-secondary-50 active:!text-white focus:!bg-secondary-50 focus:!text-white flex items-center gap-2 rounded-t">
                                                                <div
                                                                    class="group-hover:[&>svg>path]:stroke-white group-active:[&>svg>path]:stroke-white [&>svg>path]:stroke-neutral-90">
                                                                    {!! file_get_contents('assets/icons/eye.svg') !!}
                                                                </div>
                                                                Detail
                                                            </a>
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
                                                        <li>
                                                            <button
                                                                wire:click='showUploadLampiran({{ $item->id }})'
                                                                class="group/item dropdown-item text-sm py-2 px-4 font-normal w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-secondary-50 hover:text-white active:!bg-secondary-50 active:!text-white focus:!bg-secondary-50 focus:!text-white flex items-center gap-2">
                                                                <div
                                                                    class="group-hover/item:[&>svg>path]:stroke-white group-active/item:[&>svg>path]:stroke-white [&>svg>path]:stroke-neutral-90">
                                                                    {!! file_get_contents('assets/icons/outline-link.svg') !!}
                                                                </div>
                                                                Lampiran
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

    <div id="triggerModalHistory" data-bs-target="#modalHistoryPermintaanPembayaran" data-bs-toggle="modal"></div>
    <div data-bs-toggle="modal" data-bs-target="#modalUploadLampiran" class="hidden" id="triggerUploadLampiran">
    </div>
    @include('components.modal.modal-upload-lampiran')

    @include('components.modal.modal-history-permintaan-pembayaran')
</div>



@push('script')
    <script>
        $(document).ready(function(e) {
            Livewire.on('show-modal-lampiran', () => {
                $("#triggerUploadLampiran").click();
            });
            window.livewire.on('done-store-lampiran', () => {
                $("#modalUploadLampiran .btn-cancel").click()
            });
            Livewire.on('show-modal-history', () => {
                $("#triggerModalHistory").click();
            });
            var index = 0;
            $(".item-company").each(function(e) {
                if (index == 0) {
                    $(this).click()
                }
                index++
            })
        })
    </script>
@endpush
