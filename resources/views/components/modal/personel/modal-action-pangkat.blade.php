<x-ui.modal-template modalID="modalActionPangkat" modalDialogStyle="max-width:550px;">
    <x-slot name="header">
        <h5 class="text-base font-bold leading-normal text-gray-800" id="modalActionPangkat">
            {{ $typeModalActionPangkat == 'add' ? 'Tambah' : 'Edit' }} TNI
        </h5>
    </x-slot>
    <x-slot name="body">
        <form wire:submit.prevent="store">
            <div class="mb-3" wire:ignore>
                <label for="" class="mb-1 label-required" id="labelpemilik">
                    Golongan / Pangkat
                </label>
                <div wire:ignore>
                    <select wire:model="postData.jenis" class="self-stretch select2-golongan form-control" name="golongan" id="golongan">
                        <option class="text-black-40" value="" selected disabled>Pilih Golongan</option>
                        <option value="TNI">TNI</option>
                        <option value="PNS">PNS</option>
                    </select>
                </div>
                @error('postData.jenis')
                <x-ui.input-message>
                    @slot('message')
                        {{ $message }}
                    @endslot
                </x-ui.input-message>
            @enderror
            </div>
            <div class="mb-3">
                <label for="" class="label-required">
                    Nama Pangkat
                </label>
                <input type="text" class="form-control uppercase placeholder:!capitalize @error('postData.nama_pangkat') invalid @enderror" placeholder="Example : Dede Anggara"
                    wire:model="postData.nama_pangkat">
                @error('postData.nama_pangkat')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="label-required">
                    Esselon Golongan
                </label>
                <input wire:model.defer='price_format' wire:keyup='format_currency' type="text"
                    class="form-control @error('postData.golongan') invalid @enderror"
                    placeholder="Ex : 2.000.000">
                @error('postData.golongan')
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
