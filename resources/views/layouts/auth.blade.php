<!doctype html>
<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (Request::segment(1) == 'login')
            Login - Penggajihan TNI-PNS    
        @elseif(Request::segment(1) == 'forgot-password')
            Lupa Password
        @else
            Reset Password
        @endif        
    </title>
    <link rel="shortcut icon" href="{{asset('assets/images/favicon-white.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('dist/font-awesome/css/all.min.css') }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/tw-elements/index.min.css') }}" />
    <script src="{{ asset('dist/tw-elements/index.min.js') }}"></script>

    {{-- Jquery --}}
    <script src="{{ asset('assets/plugins/jquery/jquery-3.6.1.min.js') }}"></script>

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

<body>
    {{-- Loading --}}
    <section id="loading-page">
        <div class="flex items-center justify-center">
            <div class="inline-block border-2 rounded-full spinner-border animate-spin w-14 h-14 text-secondary-60"
                role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </section>
    <div class="fixed top-0 left-0 flex items-center justify-center w-full h-full">
        @yield('content')
    </div>

    @stack('script')

    <script src="{{ asset('dist/custom/spinner.js') }}"></script>
    <script>
        $(document).ready(function() {
            setTimeout(() => {
                window.hideLoading();
            }, 1500);
        })
    </script>
</body>

</html>
