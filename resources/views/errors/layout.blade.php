<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                /* font-family: 'Nunito', sans-serif; */
                /* font-weight: 100; */
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="flex-center flex-col position-ref full-height font-['Poppins']">
            <div class="content flex items-center relative">
                <div class="title font-medium !text-4xl border-r-[3px] !border-r-secondary-60 px-2 mr-2">
                    @yield('code')
                </div>
                <div class="message font-['Poppins']">
                    @yield('message')
                </div>
                <div class="absolute left-0 w-full flex items-center justify-end -bottom-[4rem] z-50">
                    <button onclick="goBack()" class="uppercase font-medium text-lg tracking-widest border-secondary-60 border-[1.5px] px-3 py-2 rounded-md text-secondary-60 transition-all duration-500 hover:bg-secondary-60 hover:text-white">
                        Kembali
                    </button>
                </div>
            </div>
            <div class="absolute left-0 bottom-0 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#9D82C4" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,197.3C384,203,480,213,576,218.7C672,224,768,224,864,208C960,192,1056,160,1152,165.3C1248,171,1344,213,1392,234.7L1440,256L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </div>
        </div>

        <script>
            function goBack() {
              window.history.back();
            }
        </script>
    </body>
</html>
