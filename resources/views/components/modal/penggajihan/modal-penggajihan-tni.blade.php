<x-ui.modal-template modalID="modalPenggajihanTni" modalDialogStyle="max-width:777px;">
    <x-slot name="header">
        <h5 class="text-base font-bold leading-normal text-gray-800" id="modalPenggajihanTni">
            {{ $typeModalActionPenggajihanTni == 'add' ? 'Buat' : 'Edit' }} Data Penggajihan TNI
        </h5>
        <span data-bs-dismiss="modal" class="hidden btn-close"></span>
    </x-slot>
    <x-slot name="body">
        <div class="relative mb-3">
            <div class="flex-1">
                <div class="relative">
                    <div class="{{$typeModalActionPenggajihanTni=='add'?'':'hidden'}}">
                        <div wire:ignore>
                            <select class="self-stretch select2-personel-tni form-control" name="personel" id="personel">
                                <option class="text-black-40" value="" selected disabled>Pilih Personel TNI</option>
                                @foreach ($personelTni as $item)
                                    <option value="{{ $item['id'] }}">
                                        {{ $item['nama_tni'] }} - {{ $item['pangkat_tni_id']['nama_pangkat']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="{{$typeModalActionPenggajihanTni=='add'?'hidden':''}}">
                        <input type="text" class="form-control" wire:model="postData.name_personel" disabled>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="flex gap-3">
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Tunjangan Suami/Istri
                    </label>
                    <input type="text" wire:model='price_keluarga' wire:keyup='format_keluarga'
                        class="form-control @error('postData.t_keluarga_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.t_keluarga_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Tunjangan Anak
                    </label>
                    <input type="text" wire:model='price_t_anak' wire:keyup='format_anak'
                        class="form-control @error('postData.t_anak_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.t_anak_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="flex gap-3">
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Tunjangan Umum
                    </label>
                    <input type="text" wire:model='price_t_umum_tni' wire:keyup='format_umum'
                        class="form-control @error('postData.t_umum_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.t_umum_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Tunjangan Beras
                    </label>
                    <input type="text" wire:model='price_t_beras_tni' wire:keyup='format_beras'
                        class="form-control @error('postData.t_beras_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu">

                    @error('postData.t_beras_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="flex gap-3">
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Tunjangan Kowan (Opsional)
                    </label>
                    <input type="text" wire:model='price_t_kowan_tni' wire:keyup='format_kowan'
                        class="form-control @error('postData.t_kowan_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.t_kowan_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Tunjangan PPh (Opsional)
                    </label>
                    <input type="text" wire:model='price_t_pph_tni' wire:keyup='format_pph'
                        class="form-control @error('postData.t_pph_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu">

                    @error('postData.t_pph_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="flex gap-3">
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Tunjangan Jabatan
                    </label>
                    <input type="text" wire:model='price_jabatan_tni' wire:keyup='format_jabatan'
                        class="form-control @error('postData.t_jabatan_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu">

                    @error('postData.t_jabatan_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Pembulatan
                    </label>
                    <input type="text" wire:model='postData.pembulatan_tni' wire:keyup="totalKotorTni()"
                        class="form-control @error('postData.pembulatan_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.pembulatan_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="flex gap-3">
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Remon (Tunjanan Kerja)
                    </label>
                    <input type="text" wire:model='price_raymon'  wire:keyup='format_raymon'
                        class="form-control @error('postData.raymond') invalid @enderror"
                        placeholder="Silahkan pilih Personel terlebih dahulu" >

                    @error('postData.raymond')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>
        <div class="flex-1">
                    <label for="" class="mb-1 label">
                        ULP
                    </label>
                    <input type="text" wire:model.defer='postData.ULP'
                        class="form-control @error('postData.ULP') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" disabled>

                    @error('postData.ULP')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
        <div class="mb-3">
            <div class="flex gap-3">
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Penghasilan Kotor
                    </label>
                    <input type="text" wire:model='postData.total_kotor_tni' 
                        class="form-control @error('postData.total_kotor_tni') invalid @enderror"
                        placeholder="Silahkan pilih Personel terlebih dahulu" disabled >

                    @error('postData.total_kotor_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="flex gap-3">
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Potongan Pensiunan
                    </label>
                    <input type="text" wire:model='price_p_pensiunan' wire:keyup='format_pensiunan' 
                        class="form-control @error('postData.p_pensiunan_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu">

                    @error('postData.p_pensiunan_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Potongan BPJS
                    </label>
                    <input type="text" wire:model='price_bpjs_tni' wire:keyup='format_bpjs'
                        class="form-control @error('postData.p_bpjs_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.p_bpjs_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="flex gap-3">
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Potongan THT
                    </label>
                    <input type="text" wire:model='price_tht_tni' wire:keyup='format_tht'
                        class="form-control @error('postData.p_tht_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu">

                    @error('postData.p_tht_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Potongan Sewa Rumah
                    </label>
                    <input type="text" wire:model='price_sewa_tni' wire:keyup='format_sewa'
                        class="form-control @error('postData.p_sewarumah_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.p_sewarumah_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="flex gap-3">
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Potongan Pajak Penghasilan (PPH)
                    </label>
                    <input type="text" wire:model='price_pajak_tni' wire:keyup='format_pajak'
                        class="form-control @error('postData.p_pajak_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu">

                    @error('postData.p_pajak_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Jumlah Potongan
                    </label>
                    <input type="text" wire:model='postData.jml_potongan_tni' 
                        class="form-control @error('postData.jml_potongan_tni') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" disabled>

                    @error('postData.jml_potongan_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="flex gap-3">
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Penghasilan Bersih
                    </label>
                    <input type="text" wire:model='postData.total_bersih_tni' 
                        class="form-control @error('postData.total_bersih_tni') invalid @enderror"
                        placeholder="Silahkan pilih Personel terlebih dahulu" disabled >

                    @error('postData.total_bersih_tni')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
            </div>
        </div>
        
    </x-slot>

    <x-slot name="footer">
        <button class="flex-1 my-btn my-btn-outline-secondary btn-cancel" type="submit" data-bs-dismiss="modal">
            Batal
        </button>
        <button class="flex-1 my-btn my-btn-secondary" type="submit" wire:click='storePenggajihanTni()'>
            Simpan
        </button>
    </x-slot>
</x-ui.modal-template>

@push('script')
    <script>
        $(document).ready(function() {

        })
    </script>
@endpush
