<div class="bg-white overflow-hidden w-full flex">
    <img src="{{ asset('assets/images/auth/password.svg') }}" alt="" class="h-screen max-[980px]:hidden">

    <div class="flex items-center justify-center flex-1 max-[980px]:fixed max-[980px]:h-full max-[980px]:p-10 max-[980px]:top-0 max-[980px]:bg-white max-[980px]:w-full">
        <div class="max-w-md">
            <div class="text-[32px] font-semibold mb-3">Ubah Password</div>
            <div class="text-neutral-70 font-normal">
                Masukan Password Baru anda, Masukan password yang mudah diingat
                agar dikemudian hari tidak lupa.
            </div>

            <div class="mt-[41px]">
                <div class="mb-3">
                    <label for="" class="label">
                        Password Baru
                    </label>
                    <div class="relative">
                        <div class="relative">
                            <input type="password" id="password"
                                class="form-control @error('postData.password') invalid @enderror"
                                placeholder="Masukan Password disini.." wire:model.defer="postData.password">
                            @error('postData.password')
                                <x-ui.input-message>
                                    @slot('message')
                                        {{ $message }}
                                    @endslot
                                </x-ui.input-message>
                            @enderror

                            <div class="absolute h-[39px] flex items-center justify-center right-4 top-0">
                                <i
                                    class="fas fa-eye-slash text-primary80 toggle-password text-neutral-90 cursor-pointer fs-12"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="label">
                        Konfirmasi Password Baru
                    </label>
                    <div class="relative">
                        <input type="password" id="password"
                            class="form-control @error('postData.password_confirmation') invalid @enderror"
                            placeholder="Masukan Password disini.." wire:model.defer="postData.password_confirmation">
                        @error('postData.password_confirmation')
                            <x-ui.input-message>
                                @slot('message')
                                    {{ $message }}
                                @endslot
                            </x-ui.input-message>
                        @enderror

                        <div class="absolute h-[39px] flex items-center justify-center right-4 top-0">
                            <i
                                class="fas fa-eye-slash text-primary80 toggle-password text-neutral-90 cursor-pointer fs-12"></i>
                        </div>
                    </div>
                </div>


                {{-- <button wire:click="store()"
                    class="my-btn bg-secondary-70 hover:bg-secondary-80 w-full mt-12 !rounded !font-light text-white">
                    Simpan
                </button> --}}
                <button wire:click="store" wire:loading.attr="disabled" wire:target='store'
                    class="my-btn bg-secondary-70 hover:bg-secondary-80 w-full mt-12 !rounded !font-light text-white">
                    <div class="items-center gap-2 justify-center hidden" wire:loading.class.add="flex"
                        wire:loading.class.remove="hidden" wire:target='store'>
                        <div class="spinner-border animate-spin inline-block w-4 h-4 border-1 rounded-full"
                            role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        Mohon tunggu...
                    </div>
                    <div wire:loading.class.add="hidden" wire:target='store'>

                        Simpan
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".toggle-password").click(function() {
                var input = $(this).parent().parent().find("input")
                var type = input.attr('type')
                if (type == "password") {
                    input.attr('type', "text");
                    $(this).addClass("fa-eye").removeClass("fa-eye-slash");
                } else {
                    input.attr('type', "password");
                    $(this).removeClass("fa-eye").addClass("fa-eye-slash");
                }
            });
        });
    </script>
@endpush
