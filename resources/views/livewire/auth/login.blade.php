<div class="flex w-full overflow-hidden bg-white">
    <img src="{{ asset('assets/images/auth/login.svg') }}" alt="" class="h-screen max-[980px]:hidden">

    <div class="flex items-center justify-center flex-1 max-[980px]:fixed max-[980px]:h-full max-[980px]:p-10 max-[980px]:top-0 max-[980px]:bg-white max-[980px]:w-full">
        <div>
            <div class="text-[32px] font-semibold">Login</div>
            <div class="font-normal text-neutral-70">
                Selamat Datang! Tolong masukan informasi login anda
            </div>

            <div class="mt-[41px]">
                <div class="flex flex-col mb-6">
                    <label for="" class="mb-2 text-sm">Username</label>
                    <input wire:model.defer="username" type="text" placeholder="Silahkan isi Username anda disini"
                        class="form-control @error('username') invalid @enderror bg-white border border-neutral-50 rounded-md text-sm p-3 py-2.5 outline-none placeholder:text-neutral-60 placeholder:font-light focus:border-secondary-60 focus:ring-0 transition duration-150" />
                    @error('username')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>
                <div class="flex flex-col mb-6">
                    <label for="" class="mb-2 text-sm">Password</label>
                    <div class="relative">
                        <input wire:model.defer="password" wire:keydown.enter="login" type="password" wire:ignore
                            placeholder="Silahkan isi Password anda disini" id="password"
                            class="form-control @error('password') invalid @enderror bg-white border border-neutral-50 rounded-md text-sm p-3 py-2.5 pr-11 outline-none placeholder:text-neutral-60 placeholder:font-light focus:border-secondary-60 focus:ring-0 transition duration-150 w-full" />
                        <div wire:click="toggleShowPassword"
                            class="absolute h-[38px] top-0 right-4 flex items-center justify-center cursor-pointer">
                            @if ($isShowPassword)
                                <i class="fa fa-eye-slash text-neutral-70"></i>
                            @else
                                <i class="fa fa-eye text-neutral-70"></i>
                            @endif
                        </div>
                    </div>
                    @error('password')
                        <x-ui.input-message>
                            @slot('message')
                                {{ $message }}
                            @endslot
                        </x-ui.input-message>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <input type="checkbox"
                            class="rounded !checked:bg-secondary-60 checked:hover:bg-secondary-60 focus:ring-secondary-60 transition duration-150 border-secondary-60 text-secondary-60" id="rememberMe" name="remember_me" wire:model.defer='isRemember' />
                        <label class="text-sm cursor-pointer" for="rememberMe">Remember me</label>
                    </div>
                    <a href="" class="text-sm font-normal cursor-pointer text-secondary-60">
                        Lupa Password ?
                    </a>
                </div>

                <button wire:click="login"
                    class="my-btn bg-primary-10 hover:bg-secondary-80 w-full mt-14 !rounded !font-light text-white">
                    Masuk
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {

            window.livewire.on('toggle-password', (value) => {
                if (value) {
                    $("#password").attr('type', 'text')
                } else {
                    $("#password").attr('type', 'password')
                }
            });

        });
    </script>
@endpush
