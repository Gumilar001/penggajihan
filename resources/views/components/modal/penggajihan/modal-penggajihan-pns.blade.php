<x-ui.modal-template modalID="modalPenggajihanPns" modalDialogStyle="max-width:777px;">
    <x-slot name="header">
        <h5 class="text-base font-bold leading-normal text-gray-800" id="modalPenggajihanPns">
            {{ $typeModalActionPenggajihanPns == 'add' ? 'Buat' : 'Edit' }} Data Penggajihan PNS
        </h5>
        <span data-bs-dismiss="modal" class="hidden btn-close"></span>
    </x-slot>
    <x-slot name="body">
        <div class="relative mb-3">
            <div class="flex-1">
                <div class="relative">
                    <div class="{{$typeModalActionPenggajihanPns=='add'?'':'hidden'}}">
                        <div wire:ignore>
                            <select class="self-stretch select2-personel form-control" name="personel" id="personel">
                                <option class="text-black-40" value="" selected disabled>Pilih Personel PNS</option>
                                @foreach ($personel as $item)
                                    <option value="{{ $item['id'] }}">
                                        {{ $item['nama_pns'] }} - {{$item['pangkat_id']['nama_pangkat']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="{{$typeModalActionPenggajihanPns=='add'?'hidden':''}}">
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
                        class="form-control @error('postData.t_keluarga') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.t_keluarga')
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
                    <input type="text" wire:model='price_anak' wire:keyup='format_anak'
                        class="form-control @error('postData.t_anak') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.t_anak')
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
                    <input type="text" wire:model='price_umum' wire:keyup='format_umum'
                        class="form-control @error('postData.t_umum') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.t_umum')
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
                    <input type="text" wire:model='price_beras' wire:keyup='format_beras'
                        class="form-control @error('postData.t_beras') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.t_beras')
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
                    <input type="text" wire:model.defer='price_jabatan' wire:keyup='format_currency'
                        class="form-control @error('postData.t_jabatan') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu">

                    @error('postData.t_jabatan')
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
                    <input type="text" wire:model='postData.pembulatan' wire:keyup="totalKotor()"
                        class="form-control @error('postData.pembulatan') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.pembulatan')
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
                        Remon (Tunjangan PNS)
                    </label>
                    <input type="text" wire:model='price_remon' wire:keyup='format_remon'
                        class="form-control @error('postData.remon') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >
    
                    @error('postData.remon')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
                <div class="flex-1">
                    <label for="" class="mb-1 label">
                        Tunjangan PPH (Opsional)
                    </label>
                    <input type="text" wire:model='price_tpp' wire:keyup='format_currency_tpp'
                        class="form-control @error('postData.t_tpp_pns') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >
    
                    @error('postData.t_tpp_pns')
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
                        Penghasilan Kotor
                    </label>
                    <input type="text" wire:model='postData.total_kotor' 
                        class="form-control @error('postData.total_kotor') invalid @enderror"
                        placeholder="Silahkan pilih Personel terlebih dahulu" disabled >

                    @error('postData.total_kotor')
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
                    <input type="text" wire:model.defer='price_pensiunan' wire:keyup='format_pensiunan' 
                        class="form-control @error('postData.p_pensiunan') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu">

                    @error('postData.p_pensiunan')
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
                    <input type="text" wire:model='price_bpjs' wire:keyup='format_currency_bpjs'
                        class="form-control @error('postData.p_bpjs') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.p_bpjs')
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
                    <input type="text" wire:model.defer='price_tht' wire:keyup='format_tht' 
                        class="form-control @error('postData.p_tht') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu">

                    @error('postData.p_tht')
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
                    <input type="text" wire:model='price_sewa' wire:keyup='format_currency_sewa'
                        class="form-control @error('postData.p_sewarumah') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" >

                    @error('postData.p_sewarumah')
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
                        Potongan Pajak Penghasilan
                    </label>
                    <input type="text" wire:model='price_pajak' wire:keyup='format_currency_pajak'
                        class="form-control @error('postData.p_pajak') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu">

                    @error('postData.p_pajak')
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
                    <input type="text" wire:model.defer='postData.jml_potongan' 
                        class="form-control @error('postData.jml_potongan') invalid @enderror"
                        placeholder="Silahkan pilih personel terlebih dahulu" disabled>

                    @error('postData.jml_potongan')
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
                    <input type="text" wire:model='postData.total_bersih' 
                        class="form-control @error('postData.total_bersih') invalid @enderror"
                        placeholder="Silahkan pilih Personel terlebih dahulu" disabled >

                    @error('postData.total_bersih')
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
        <button class="flex-1 my-btn my-btn-secondary" type="submit" wire:click='storePenggajihan()'>
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
