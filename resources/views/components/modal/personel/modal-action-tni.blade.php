<x-ui.modal-template modalID="modalActionTni" modalDialogStyle="max-width:550px;">
    <x-slot name="header">
        <h5 class="text-base font-bold leading-normal text-gray-800" id="modalActionTni">
            {{ $typeModalActionTni == 'add' ? 'Tambah' : 'Edit' }} TNI
        </h5>
    </x-slot>
    <x-slot name="body">
        <form wire:submit.prevent="store">
            <div class="mb-3">
                <label for="" class="label-required">
                    Nrp
                </label>
                <input type="number" class="form-control uppercase placeholder:!capitalize @error('postData.nrp') invalid @enderror" placeholder="Example : 1320002320201"
                    wire:model="postData.nrp">
                @error('postData.nrp')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="label-required">
                    Nama TNI
                </label>
                <input type="text" class="form-control @error('postData.nama_tni') invalid @enderror" placeholder="Example : Wildan"
                    wire:model="postData.nama_tni">
                @error('postData.nama_tni')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="label-required">
                    NPWP
                </label>
                <input type="number" class="form-control uppercase placeholder:!capitalize @error('postData.npwp') invalid @enderror" placeholder="Example : 1320002320201"
                    wire:model="postData.npwp">
                @error('postData.npwp')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            </div>
            <div class="mb-3">
                <div class="flex flex-col items-start flex-1">
                    <label for="" class="{{$isDisabledPicker?'label !text-neutral-70':'label-required'}} mb-1">
                        Tanggal Lahir
                    </label>
                    <x-ui.input-with-icon>
                        <x-slot name="input">
                            <input type="text" id="date" placeholder="-- / -- / ----"
                                class="form-control @error('postData.tgl_lahir') invalid @enderror"
                                wire:model.defer="postData.tgl_lahir" readonly wire:ignore.self {{$isDisabledPicker?'disabled':''}}>
                            @error('postData.tgl_lahir')
                                <x-ui.input-message>
                                    @slot('message')
                                        {{ $message }}
                                    @endslot
                                </x-ui.input-message>
                            @enderror
                        </x-slot>
                        <x-slot name="icon">
                            {!! file_get_contents('assets/icons/outline-calendar.svg') !!}
                        </x-slot>
                    </x-ui.input-with-icon>
                </div>
            </div>
            <div class="mb-3" wire:ignore>
                <label for="" class="mb-1 label-required" id="labelpemilik">
                    Golongan / Pangkat
                </label>
                <div wire:ignore>
                    <select class="self-stretch select2-pangkat form-control" name="pangkat" id="pangkat">
                        <option class="text-black-40" value="" selected disabled>Pilih Golongan/Pangkat</option>
                        @foreach ($golongan as $item)
                            <option value="{{ $item['id'] }}">
                                {{ $item['nama_pangkat'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('postData.id_pangkat')
                <x-ui.input-message>
                    @slot('message')
                        {{ $message }}
                    @endslot
                </x-ui.input-message>
            @enderror
            </div>
            <div class="mt-3 mb-3">
                <div class="flex items-center gap-3 mt-[5px]">
                    <input type="checkbox" class="cursor-pointer" wire:model.defer="postData.status_menikah" id="cbx1" onchange="select()">
                    <label for="cbx1" class="m-0 text-xs cursor-pointer">Status Menikah <span class="text-neutral-70">(Ceklis Jika Sudah Menikah)</span> </label>
                </div>
            </div>
            <div wire:ignore class="mb-3 wrapper-jml-anak" hidden>
                <label for="" class="label-required">
                    Jumlah Anak
                </label>
                <input type="number" class="form-control @error('postData.jumlah_anak') invalid @enderror"
                    placeholder="Example : 2" wire:model.defer="postData.jumlah_anak" id="jumlah_anak">
                @error('postData.jumlah_anak')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="label-required">
                    Gaji Pokok
                </label>
                <input wire:model.defer='price_format' wire:keyup='format_currency' type="text"
                    class="form-control @error('postData.gajih_pokok') invalid @enderror"
                    placeholder="Ex : 2.000.000">
                @error('postData.gajih_pokok')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            </div>
            <div wire:ignore class="mb-3" >
                <label for="" class="label-required">
                    No Whatsapp
                </label>
                <input type="text" class="form-control @error('postData.no_whatsapp') invalid @enderror"
                    placeholder="Example : 08991782932" wire:model.defer="postData.no_whatsapp" id="no_whatsapp">
                @error('postData.no_whatsapp')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            </div>
        </form>
    </x-slot>
    <x-slot name="footer">
        <button class="flex-1 my-btn my-btn-outline-secondary btn-cancel" data-bs-dismiss="modal" type="button">
            Batal
        </button>
        <button class="flex-1 my-btn my-btn-secondary" type="submit" wire:click="store()">
            Simpan
        </button>
    </x-slot>
</x-ui.modal-template>
@push('script')
    <script>
        $(document).ready(function (){
            function renderPicker() {
                flatpickr("#date", {
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                });
                console.log('Flatpickr Render')
            }
            renderPicker()

        })
    </script>
@endpush
