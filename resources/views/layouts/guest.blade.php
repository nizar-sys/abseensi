<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Abseensi') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- CSS files -->
    <link href="{{ asset('/design-docs') }}/dist/css/tabler.min.css?1667333929" rel="stylesheet" />
    <link href="{{ asset('/design-docs') }}/dist/css/tabler-flags.min.css?1667333929" rel="stylesheet" />
    <link href="{{ asset('/design-docs') }}/dist/css/tabler-payments.min.css?1667333929" rel="stylesheet" />
    <link href="{{ asset('/design-docs') }}/dist/css/tabler-vendors.min.css?1667333929" rel="stylesheet" />
    <link href="{{ asset('/design-docs') }}/dist/css/demo.min.css?1667333929" rel="stylesheet" />
    <link href="{{ asset('/design-docs') }}/dist/css/snackbar.css" rel="stylesheet" />
    {{-- scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
    </style>
    @yield('css')
</head>

<body class="border-top-wide border-primary d-flex flex-column">
    <script src="{{ asset('/design-docs') }}/dist/js/demo-theme.min.js?1667333929"></script>

    {{ $slot }}

    <script src="{{ asset('/design-docs') }}/dist/js/tabler.min.js?1667333929" defer></script>
    <script src="{{ asset('/design-docs') }}/dist/js/demo.min.js?1667333929" defer></script>
    <script src="{{ asset('/design-docs') }}/dist/js/snackbar.js"></script>
    <script>
        @if (Session::has('success-logout'))
            SnackBar({
                message: "Berhasil keluar!",
                position: "bc",
                width: "500px",
                status: 'success'
            });
        @endif
    </script>
    @yield('script')
</body>

</html>
