<div>
    <div class="bg-white shadow-sm rounded-3xl w-full p-[30px] min-h-[300px] mb-6">

        <div class="flex items-center gap-4 mb-9">
            <div class="[&>svg>path]:fill-secondary-100">
                {!! file_get_contents('assets/icons/setting.svg') !!}
            </div>
            <div class="title-page font-bold text-black-80">
                Settings
            </div>
        </div>

        <div class="relative">
            <div class="wrapper-bg-account">

            </div>
            <div class="wrapper-profile absolute top-[130px]">
                <div class="account-profile flex-wrap">
                    <div class="profile-image" data-bs-toggle="modal" data-bs-target="#modalEditProfile">
                        <div class="hover-overlay">
                            <svg width="38" height="38" viewBox="0 0 38 38" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.0834 6.58333H6.50008C4.38299 6.58333 2.66675 8.29957 2.66675 10.4167V31.5C2.66675 33.6171 4.38299 35.3333 6.50008 35.3333H27.5834C29.7006 35.3333 31.4167 33.6171 31.4167 31.5V21.9167M28.7062 3.87276C30.2031 2.37575 32.6304 2.37575 34.1273 3.87276C35.6244 5.36975 35.6244 7.79688 34.1273 9.2939L17.6712 25.75H12.2501V20.3289L28.7062 3.87276Z"
                                    stroke="white" stroke-width="3.83333" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        @if ($user['foto'])
                            <img src="{{ $user['foto'] }}" alt="" class="rounded-circle b-0">
                        @else
                            <img src="{{ asset('assets/images/default-avatar.svg') }}" alt=""
                                class="rounded-circle">
                        @endif
                    </div>
                    <div class="flex flex-col relative top-7">
                        <div class="font-bold text-name">
                            {{ $user['name'] ?? '-' }}
                        </div>
                        <div class="text-sm text-neutral-70 capitalize text-name">
                            {{ $user['role'] ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-start gap-8 text-sm relative mt-28 flex-wrap md:!flex-nowrap">
            <div class="w-full md:!w-56">
                <div wire:click='selectTab(0)'
                    class="flex items-center cursor-pointer gap-2 rounded h-[44px] hover:bg-slate-50 px-3 transition-all duration-150 {{ $selectedTab == 0 ? '!bg-secondary-50 text-white' : 'text-secondary-100' }}">
                    <div
                        class="{{ $selectedTab == 0 ? '[&>svg>path]:fill-white' : '[&>svg>path]:fill-secondary-100' }}">
                        {!! file_get_contents('assets/icons/user.svg') !!}
                    </div>
                    <div>
                        Informasi Profile
                    </div>
                </div>
                <div wire:click='selectTab(1)'
                    class="flex items-center cursor-pointer gap-2 rounded h-[44px] hover:bg-slate-50 px-3 transition-all duration-150 {{ $selectedTab == 1 ? '!bg-secondary-50 text-white' : 'text-secondary-100' }}">
                    <div
                        class="{{ $selectedTab == 1 ? '[&>svg>path]:fill-white' : '[&>svg>path]:fill-secondary-100' }}">
                        {!! file_get_contents('assets/icons/password.svg') !!}
                    </div>
                    <div>
                        Ubah Password
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <div class="min-h-[350px]">
                    @if ($selectedTab == 0)
                        @include('livewire.setting.profile')
                    @else
                        @include('livewire.setting.password')
                    @endif
                </div>

            </div>
        </div>

        <div class="flex gap-3 justify-end mt-10">
            <button wire:click='cancel()' class="my-btn my-btn-outline-secondary w-[200px]">
                Batal
            </button>
            <button wire:click='store()' class="my-btn my-btn-secondary w-[200px]">
                Simpan
            </button>
        </div>
    </div>

    {{-- Modal --}}

    <div class="hidden" id="triggerEditProfile" data-bs-target="#modalEditProfile" data-bs-toggle="modal"></div>

    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
        id="modalEditProfile" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div
                class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-5 pt-[30px] rounded-t-md">
                    <div class="flex items-center justify-between mb-3 flex-1">
                        <div class="fs-20 font-medium">Edit Profile</div>
                        <i class="fa fa-times cursor-pointer text-danger-60 btn-cancel" data-bs-dismiss="modal"></i>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="px-4">
                        <div class="wrapper-image-preview mb-2 mx-auto w-100 !bg-profile">
                            @if (isset($user['foto']))
                                <img src="{{ $user['foto'] }}" class="img-prev w-100 h-100" alt=""
                                    id="imgPreview">
                            @else
                                <img src="{{ asset('assets/images/default-avatar.svg') }}" class="img-prev w-100 h-100"
                                    alt="" id="imgPreview">
                            @endif

                        </div>
                        <div class="mb-2">
                            <input type="file" class="hidden" id="browse-file"
                                accept="image/png, image/jpg, image/jpeg">
                            <label class="my-btn btn-browse bg-primary-80 text-white text-base w-full m-0"
                                for="browse-file">
                                Pilih Gambar Disini
                            </label>
                        </div>
                        <div class="mb-5 flex items-center gap-2">
                            <button class="my-btn my-btn-outline-secondary flex-1 reset-img">
                                Hapus Gambar
                            </button>
                            <button class="my-btn my-btn-secondary flex-1 btn-save-img">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('select-tab', (val) => {
                if (val == 1) {
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
                }
            });

            window.livewire.on('done-update-profile', (src) => {
                if(src) {
                    $("#imgProfileHeader").attr('src', src);
                }
            });

            let cropper;

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#imgPreview').attr('src', e.target.result);
                        setTimeout(() => {
                            const image = document.getElementById('imgPreview');
                            if (cropper != null) {
                                cropper.destroy()
                            }
                            cropper = new Cropper(image, {
                                aspectRatio: 1 / 1,
                                crop(event) {
                                    // console.log(event.detail.x);
                                    // console.log(event.detail.y);
                                    // console.log(event.detail.width);
                                    // console.log(event.detail.height);
                                    // console.log(event.detail.rotate);
                                    // console.log(event.detail.scaleX);
                                    // console.log(event.detail.scaleY);
                                },
                            });
                        }, 300);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#browse-file").change(function() {
                // alert('asd');
                readURL(this);
            })

            $(".btn-save-img").click(function() {
                var result = cropper.getCroppedCanvas().toDataURL('image/jpeg')
                $("#modalEditProfile .btn-cancel").click()
                Livewire.emit('uploadFoto', result)
                $(".profile-image img").attr("src", result)
                $("#profiles").attr("src", result)
            })

            $(".reset-img").click(function() {
                $("#modalEditProfile .btn-cancel").click()
                Livewire.emit('resetFoto')
            })
        });
    </script>
@endpush
