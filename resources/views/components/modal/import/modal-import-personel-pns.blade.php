<x-ui.modal-template modalID="modalImportPersonelPns" modalDialogClasses="modal-dialog-centered"
    modalDialogStyle="max-width:600px;">
    <x-slot name="header">
        <div class="flex flex-col">
            <h5 class="text-base font-bold leading-normal text-gray-800" id="modalImportPersonelPns">
                Import Personel Pns
            </h5>
            <div class="text-sm text-neutral-70">
                Upload template excel pada form dibawah ini
            </div>
        </div>
    </x-slot>
    <x-slot name="body">
        <div class="mt-2 mb-3">
            <div class="mb-3 text-sm text-neutral-70">
                Sebelum import pastikan download template import dibawah ini terlebih dahulu
            </div>
            <button wire:click='downloadTemplateImport()' class="w-full my-btn my-btn-secondary">
                Download Template Import
            </button>
            
            <div class="relative h-3 max-w-xl mt-5 overflow-hidden rounded-full">
                <div class="absolute w-full h-full bg-gray-200"></div>
                <div class="absolute h-full bg-secondary-80" id="progress"></div>
            </div>

            @if (!$fileUpload)
                <label for="browseUsers"
                    class="drop-area-import @error('fileUpload') invalid @enderror min-h-[182px] w-full rounded-[10px] border-dashed border-2 mt-3 flex flex-col items-center justify-center py-3 cursor-pointer hover:bg-import-hover hover:border-secondary-60 transition-all duration-150">
                    <img src="{{ asset('assets/images/import_drag.svg') }}" alt="" class="mb-3">
                    <div class="mb-1 text-sm font-medium">
                        Drag File Import disini
                    </div>
                    <div class="text-xs text-neutral-70">
                        atau klik area ini dan pilih file
                    </div>
                    <input wire:model='fileUpload' id="browseUsers" type="file" class="hidden"
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
                    class="min-h-[182px] w-full rounded-[10px] border-dashed border-2 mt-3 flex flex-col items-start justify-center py-3 px-9">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-center w-20 h-20 p-3 rounded-lg bg-secondary-10">
                            <img src="{{ asset('assets/icons/document-text.svg') }}" alt="">
                        </div>
                        <div class="flex flex-col items-start">
                            <div class="font-semibold">
                                {{ $fileUpload->getClientOriginalName() }}
                            </div>
                            <div class="my-1 text-sm">
                                {{ humanFileSize($fileUpload->getSize()) }}
                            </div>
                            <div wire:click='removeFileUpload()'
                                class="inline-block px-4 py-1 text-sm text-white rounded-md cursor-pointer bg-danger-50">
                                Hapus
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <div class="mt-3 text-sm text-danger-50">
                Pastikan header tabel tidak dirubah, format penulisan disesuaikan dengan template
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <button wire:click='removeFileUpload()' class="flex-1 my-btn my-btn-outline-secondary btn-cancel"
            data-bs-dismiss="modal">
            Batal
        </button>
        <button wire:click='import' class="flex-1 my-btn my-btn-secondary">
            Import
        </button>
    </x-slot>
</x-ui.modal-template>
