<!DOCTYPE html>
<html lang="en" class="bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --}}
    <title>PENGGAJIHAN SIGAP</title>
    <link href="{{ asset('dist/font/inter/stylesheet.css') }}" rel="stylesheet">
</head>
<style>
    @page {
        size: 7in 9.25in;
        /* margin: 27mm 16mm 27mm 16mm; */
    }

    @media print {
        @page {
            size: A4;
            /* DIN A4 standard, Europe */
            margin: 1cm;
        }
    }

    html,
    body {
        /* height: 297mm; */
        min-height: 842px;
        width: 210mm;
        margin: 0 auto;
        font-family: 'Inter';
        font-weight: normal;
        font-style: normal;
    }

    .font-bold {
        font-weight: 700;
    }

    .font-semibold {
        font-weight: 600;
    }

    .italic {
        font-style: italic;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .my-4 {
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .mt-4 {
        margin-top: 1rem;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .mt-6 {
        margin-top: 1.5rem;
    }

    .mt-5 {
        margin-top: 1.25rem;
    }

    .mb-5 {
        margin-bottom: 1.25rem;
    }

    .mb-6 {
        margin-bottom: 1.5rem;
    }

    .px {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .pl-4 {
        padding-left: 1rem;
    }

    .p-2 {
        padding: 0.5rem;
    }

    .border {
        border: 1px solid #142232;
    }

    .text-sm {
        font-size: 14px;
    }

    .border-t-1 {
        border-top-width: 1px;
        border-style: solid;
    }

    .border-neutral-40 {
        border-color: #E7E7E7;
    }

    table {
        font-size: 14px;
        width: 100%;
        border-collapse: collapse;
    }

    .table-bordered {
        border-width: 1px;
        border-style: solid;
    }

    .table-bordered tr td,
    .table-bordered tr th {
        border-right-width: 1px;
        border-bottom-width: 1px;
    }

    .table-border-black {
        border-color: #142232;
    }

    .table-border-black tr td,
    .table-border-black tr th {
        border-color: #142232;
    }

    .table-invoice tr td {
        padding: 0.5rem !important;
        padding-top: 0.25rem !important;
        padding-bottom: 0.25rem !important;
    }

    .table-minimal tr td {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    table tr td {
        text-align: left;
        padding-left: 16px;
        padding-right: 16px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .flex {
        display: flex;
    }

    .items-start {
        align-items: flex-start;
    }

    .items-end {
        align-items: flex-end;
    }

    .items-center {
        align-items: center;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .gap-3 {
        gap: 0.75rem;
    }

    .justify-start {
        justify-content: flex-start;
    }

    .justify-between {
        justify-content: space-between;
    }

    .flex-col {
        flex-direction: column;
    }

    .align-top {
        vertical-align: top;
    }

    .mr-5 {
        margin-right: 20px;
    }

    .whitespace-nowrap {
        white-space: nowrap;
    }
</style>

<body class="bg-white">
    <div>
        <div class="px-6">
            <div class="flex items-center justify-between flex-1 mt-4">
                <div class="flex flex-col text-sm">
                    <div>
                        PUSAT PENDIDIKAN KODIKLAT AU
                    </div>
                    <div>WINGDIK 500/UMUM</div>
                    <div class="mt-2 mb-6 border-t-1 border-neutral-60"></div>
                </div>
                <div>
                    <img src="{{ asset('assets/images/logo1.svg') }}" alt="" style="">
                </div>
            </div>
            <div class="font-bold text-center">
                PEMBAYARAN PENGHASILAN & ULP
            </div>
            <div class="flex items-center justify-between mt-10 text-sm text-neutral-100">
                <div>
                    <div class="flex items-center">
                        <div class="w-36">
                            BULAN GAJIH
                        </div>
                        <div class="w-5 text-left" style="margin-left: 40px">
                            :
                        </div>
                        <div  class="font-semibold">
                            {{ $view->bulan_penggajihan ? Carbon\Carbon::createFromFormat('m', $view->bulan_penggajihan)->format('F') : 0}}
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-36">
                            NAMA
                        </div>
                        <div class="w-5 text-left" style="margin-left:90px">
                            :
                        </div>
                        <div class="font-semibold">
                            {{ $view['PersonelTni']->nama_tni }}
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-28">
                            PANGKAT/NRP
                        </div>
                        <div class="w-5 text-left" style="margin-left: 35px">
                            :
                        </div>
                        <div class="ml-2 font-semibold">
                            {{ $view['PersonelTni']['pangkatTniId']->nama_pangkat }}/{{ $view['PersonelTni']->nrp }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <table class="table-bordered table-border-black table-minimal" border="1">
                    <tr>

                        <td colspan="2" class="p-0 align-top" width="50%">
                            <div class="mb-4">
                                <table class="table-borderless table-invoice">
                                    <tr>GAJIH POKOK</tr>
                                    <tr>
                                        <td class="min-w-[100px] align-top">T. Suami/Istri</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->t_keluarga)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>T. Anak</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->t_anak)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>T. Umum</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->t_umum)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>T. Beras</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div style="width: 200px;word-break: break-word;">
                                                    Rp. {{currency_IDR($view->t_beras)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>T. Kowan</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->t_kowan ?? 0)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>T. PPH</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->t_pph ?? 0)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>T. JABATAN</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->t_struktural ?? 0)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>RAYMON</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->raymond ?? 0)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>ULP</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->laukpauk ?? 0)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>PEMBULATAN</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->pot_pembulatan ?? 0)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td colspan="3" class="p-0 align-top">
                            <div class="mb-4">
                                <table class="table-borderless table-invoice">
                                    <tr>POTONGAN KOTOR</tr>
                                    <tr>
                                        <td class="min-w-[100px] align-top">P. PENSIUNAN</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->p_pensiunan)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="min-w-[100px] align-top">P. BPJS</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div>
                                                    Rp. {{currency_IDR($view->p_bpjs)}}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-top">P. THT</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div style="width: 200px;word-break: break-word;">
                                                    Rp. {{currency_IDR($view->p_tht)}}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-top">P. SEWA RUMAH</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div style="width: 200px;word-break: break-word;">
                                                    Rp. {{currency_IDR($view->p_sewa_rumah)}}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-top">P. PPH PENGHASILAN</td>
                                        <td>
                                            <div class="flex items-start gap-3">
                                                <div>:</div>
                                                <div style="width: 200px;word-break: break-word;">
                                                    Rp. {{currency_IDR($view->t_tpp)}}</div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="">
                            PENGHASILAN KOTOR
                            <td class="text-right">
                                Rp. {{ currency_IDR($view->penghasilan_kotor)}}
                            </td>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="">
                            JUMLAH POTONGAN 
                            <td class="text-right">
                                Rp. {{ currency_IDR($view->jumlah_potongan)}}
                            </td>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="">
                            TOTAL BERSIH YANG DIBAYARKAN 
                            <td class="text-right">
                                Rp. {{ currency_IDR($view->penghasilan_bersih)}}
                            </td>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="my-4">
                <div class="mb-4 text-sm">Say Total :</div>
                <div style="border:1.5px solid #142232; padding-top:10px;padding-bottom:10px;text-transform:capitalize;"
                    class="text-sm italic font-bold text-center capitalize">
                    {{ sayTotal($view->penghasilan_bersih) }}
                </div>
            </div>

{{-- 
            <div class="flex items-end justify-between mt-5">
                <div class="flex items-center justify-start gap-2">
                  
                </div>
                <div class="flex flex-col items-center justify-center text-sm" style="margin-right: 1cm">
                    <div>Regards,</div>
                    <div class="min-h-[70px] flex items-center justify-center" style="min-height: 70px;">
                    </div>
                    <div class="mb-5 font-semibold">
                        <div class="text-center underline" style="text-decoration: underline;">
                            dede
                        </div>
                        <div style="font-size:11px;font-style:italic;margin-top:4px;" class="text-center">
                            Director
                        </div>
                    </div>
                </div>
            </div> --}}


        </div>
    </div>

    <script type="text/javascript">
        setTimeout(() => {
            window.print()
        }, 1500)
    </script>
</body>

</html>
