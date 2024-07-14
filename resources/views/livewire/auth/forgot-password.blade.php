<div class="bg-white overflow-hidden w-full flex">
    <img src="{{ asset('assets/images/auth/password.svg') }}" alt="" class="h-screen max-[980px]:hidden">

    <div class="flex items-center justify-center flex-1 max-[980px]:fixed max-[980px]:h-full max-[980px]:p-10 max-[980px]:top-0 max-[980px]:bg-white max-[980px]:w-full">
        <div class="max-w-md">
            <div class="text-[32px] font-semibold mb-3">Lupa password</div>
            <div class="text-neutral-70 font-normal">
                Masukan Email Anda dibawah ini, kami akan mengirimkan link ubah
                password ke email anda.
            </div>

            <div class="mt-[41px]">
                <div class="mb-6 flex flex-col">
                    <label for="" class="text-sm mb-2">Email</label>
                    <input wire:model.defer="email" type="text" placeholder="Masukan Email anda disini"
                        class="form-control @error('email') invalid @enderror" />
                    @error('email')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>

                <button wire:click="submit" wire:loading.attr="disabled" wire:target='submit'
                    class="my-btn bg-secondary-70 hover:bg-secondary-80 w-full mt-12 !rounded !font-light text-white">
                    <div class="items-center gap-2 justify-center hidden" wire:loading.class.add="flex" wire:loading.class.remove="hidden" wire:target='submit'>
                        <div class="spinner-border animate-spin inline-block w-4 h-4 border-1 rounded-full" role="status">
                            <span class="visually-hidden">Loading...</span>
                          </div>
                        Mohon tunggu...
                    </div>
                    <div wire:loading.class.add="hidden" wire:target='submit'>

                        Kirim
                    </div>
                </button>


                <div class="mt-14 flex items-center gap-2 justify-center text-sm text-neutral-100" wire:loading.class.add="pointer-events-none" wire:target='submit'>
                    Sudah ingat?
                    <a href="/login"
                        class="text-secondary-60 font-semibold cursor-pointer transition-all duration-150 hover:text-secondary-70">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
@endpush
