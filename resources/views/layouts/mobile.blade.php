<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Penggajihan TNI-PNS</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-white.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('dist/font-awesome/css/all.min.css') }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/tw-elements/index.min.css') }}" />
    <script src="{{ asset('dist/tw-elements/index.min.js') }}"></script>

    {{-- Jquery --}}
    <script src="{{ asset('assets/plugins/jquery/jquery-3.6.1.min.js') }}"></script>

    {{-- Perfect Scrollbar --}}
    <link href="{{ asset('dist/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('dist/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    {{-- Select2 --}}
    <link href="{{ asset('dist/select2/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('dist/select2/select2.min.js') }}"></script>

    {{-- Flatpickr --}}
    <link rel="stylesheet" href="{{ asset('dist/flatpickr/flatpickr.min.css') }}">
    <script src="{{ asset('dist/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('dist/flatpickr/id.js') }}"></script>

    {{-- CROPPER JS --}}
    <script src="{{ asset('dist/cropperjs/cropper.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dist/cropperjs/cropper.min.css') }}">

    {{-- APEXCHART --}}
    <script src="{{ asset('dist/apexcharts/apexcharts.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('dist/apexcharts/apexcharts.css') }}">

    @livewireStyles

    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />

    <style>
        .m-fadeOut {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s linear 300ms, opacity 300ms;
        }

        .m-fadeIn {
            visibility: visible;
            opacity: 1;
            transition: visibility 0s linear 0s, opacity 300ms;
        }
    </style>
</head>

<body class="overflow-hidden overflow-x-hidden">
    <div class="overlay"></div>
    {{-- Loading --}}
    <section id="loading-page">
        <div class="flex items-center justify-center">
            <div class="inline-block border-2 rounded-full spinner-border animate-spin w-14 h-14 text-secondary-60"
                role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>
    
    @stack('script')

    <!-- Required popper.js -->
    <script src="https://unpkg.com/@popperjs/core@2.9.1/dist/umd/popper.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new Tooltip(tooltipTriggerEl);
        });
    </script>

    <script src="{{ asset('dist/custom/spinner.js') }}"></script>

    <script>
        $(document).ready(function() {
            setTimeout(() => {
                window.hideLoading();
            }, 1500);

            $(".trigger-toggle-sidebar").click(function(e) {
                $("#sidebar").addClass('open');
                $("body").addClass('sidebar-open');
            })

            $("body .overlay").click(function(e) {
                $("#sidebar").removeClass('open');
                $("body").removeClass('sidebar-open');
            })

            $(".input-number").on('keydown', function(e) {
                if (!isNaN(e.key * 0)) {
                    var id = $(this).attr('id');
                    var value = $("#" + id).val();
                    var inputVal = parseInt(e.key);
                    if (isNaN(parseInt(value))) value = 0;

                    var max = $(this).attr('max');

                    try {
                        var total = value + inputVal
                        if (parseInt(total) > parseInt(max)) {
                            e.preventDefault();
                        }
                    } catch (error) {}


                }

                if (e.key == ".") {
                    try {
                        var el = $("#" + $(this).attr('id'));
                        if ((el.val()).includes(".")) {
                            e.preventDefault();
                        }
                    } catch (error) {

                    }
                }

                if (isNaN(e.key * 0) && e.key != "Backspace" && e.key != ".") {
                    e.preventDefault();
                }
            });

            $(".input-currency").on('keydown', function(e) {
                if (isNaN(e.key * 0) && e.key != "Backspace" && e.key != ".") {
                    e.preventDefault();
                }
            });
        })
    </script>
</body>

</html>
