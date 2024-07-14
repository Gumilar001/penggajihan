<x-ui.modal-template modalID="modalImportSuppliersItem" modalDialogClasses="modal-dialog-centered"
    modalDialogStyle="max-width:600px;">
    <x-slot name="header">
        <div class="flex flex-col">
            <h5 class="text-base font-bold leading-normal text-gray-800">
                Import Barang
            </h5>
            <div class="text-sm text-neutral-70">
                Upload template excel pada form dibawah ini
            </div>
        </div>
    </x-slot>
    <x-slot name="body">
        <div class="mt-2 mb-3">
            <div class="text-sm text-neutral-70 mb-3">
                Sebelum import pastikan download template import dibawah ini terlebih dahulu
            </div>
            <button wire:click='downloadTemplateImport()' class="my-btn my-btn-secondary w-full">
                Download Template Import
            </button>

            <div class="h-3 relative max-w-xl rounded-full overflow-hidden mt-5 {{$progressUpload>0?'':'hidden'}}">
                <div class="w-full h-full bg-gray-200 absolute"></div>
                <div class="h-full bg-secondary-80 absolute _progress"></div>
            </div>
            
            @if (!$fileUpload)
                <label for="browseSuppliers"
                    class="drop-area-import @error('fileUpload') invalid @enderror min-h-[182px] w-full rounded-[10px] border-dashed border-2 mt-7 flex flex-col items-center justify-center py-3 cursor-pointer hover:bg-import-hover hover:border-secondary-60 transition-all duration-150">
                    <img src="{{ asset('assets/images/import_drag.svg') }}" alt="" class="mb-3">
                    <div class="text-sm font-medium mb-1">
                        Drag File Import disini
                    </div>
                    <div class="text-xs text-neutral-70">
                        atau klik area ini dan pilih file
                    </div>
                    <input wire:model='fileUpload' id="browseSuppliers" type="file" class="hidden"
                        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </label>
                @error('fileUpload')
                    <x-ui.input-message>
                        @slot('message')
                            {{ $message }}
                        @endslot
                    </x-ui.input-message>
                @enderror
            @else
                <div
                    class="min-h-[182px] w-full rounded-[10px] border-dashed border-2 mt-7 flex flex-col items-start justify-center py-3 px-9">
                    <div class="flex gap-4 items-center">
                        <div class="h-20 w-20 flex items-center justify-center bg-secondary-10 rounded-lg p-3">
                            <img src="{{ asset('assets/icons/document-text.svg') }}" alt="">
                        </div>
                        <div class="flex flex-col items-start">
                            <div class="font-semibold">
                                {{ $fileUpload->getClientOriginalName() }}
                            </div>
                            <div class="text-sm my-1">
                                {{ humanFileSize($fileUpload->getSize()) }}
                            </div>
                            <div wire:click='removeFileUpload()'
                                class="bg-danger-50 text-white rounded-md py-1 px-4 inline-block text-sm cursor-pointer">
                                Hapus
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <div class="text-sm text-danger-50 mt-3">
                Pastikan header tabel tidak dirubah, format penulisan disesuaikan dengan template
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <button wire:click='removeFileUpload()' class="my-btn my-btn-outline-secondary flex-1 btn-cancel"
            data-bs-dismiss="modal">
            Batal
        </button>
        <button wire:click='import' class="my-btn my-btn-secondary flex-1">
            Import
        </button>
    </x-slot>
</x-ui.modal-template>
