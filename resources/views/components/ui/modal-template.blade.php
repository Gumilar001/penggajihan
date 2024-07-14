<!-- Modal -->
<div wire:ignore.self
    class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="{{ $modalID }}" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog {{$modalDialogClasses??''}} relative w-auto pointer-events-none" style="{{ $modalDialogStyle ?? '' }}">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-5 pt-[30px] rounded-t-md">
                {{ $header }}
            </div>
            <div class="modal-body relative px-5">
                {{ $body }}
            </div>
            <div
                class="modal-footer flex flex-shrink-0 flex-wrap items-center gap-5 p-5 rounded-b-md {{ $footerClasses ?? '' }}">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>
