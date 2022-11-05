<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- CSS files -->
    <link href="{{ asset('/design-docs') }}/dist/css/tabler.min.css?1667333929" rel="stylesheet" />
    <link href="{{ asset('/design-docs') }}/dist/css/tabler-flags.min.css?1667333929" rel="stylesheet" />
    <link href="{{ asset('/design-docs') }}/dist/css/tabler-payments.min.css?1667333929" rel="stylesheet" />
    <link href="{{ asset('/design-docs') }}/dist/css/tabler-vendors.min.css?1667333929" rel="stylesheet" />
    <link href="{{ asset('/design-docs') }}/dist/css/demo.min.css?1667333929" rel="stylesheet" />
    <link href="{{ asset('/design-docs') }}/dist/css/snackbar.css" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: Inter, -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
    </style>
    @yield('css')
</head>

<body>
    <script src="{{ asset('/design-docs') }}/dist/js/demo-theme.min.js?1667333929"></script>

    <div class="modal modal-blur fade" id="modal-logout" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-danger"></div>
                <div class="modal-body text-center py-4">
                    <x-icon type="alert-triangle" classicon="mb-2 text-danger icon-lg" />
                    <div class="text-muted">Apakah yakin akan keluar?
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Batal
                                </a>
                            </div>
                            <div class="col">
                                <form method="POST" id="form-logout" action="{{ route('logout') }}">
                                    @csrf
                                </form>
                                <a href="{{ route('logout') }}"
                                    onclick="document.getElementById('form-logout').submit()"
                                    class="btn btn-danger w-100" data-bs-dismiss="modal">
                                    Keluar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (isset($modals))
        {{ $modals }}
    @endif

    <div class="page">
        <!-- Navbar -->
        <x-header type="normal" />
        <div class="page-wrapper">
            @if (isset($header))
                {{ $header }}
            @endif
            <!-- Page body -->
            <div class="page-body">
                {{ $slot }}
            </div>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; {{ date('Y') }}
                                    <a href="{{ route('home') }}" class="link-secondary">Abseensi</a>.
                                    All rights reserved.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('/design-docs') }}/dist/libs/apexcharts/dist/apexcharts.min.js?1667333929" defer></script>
    <script src="{{ asset('/design-docs') }}/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1667333929" defer></script>
    <script src="{{ asset('/design-docs') }}/dist/libs/jsvectormap/dist/maps/world.js?1667333929" defer></script>
    <script src="{{ asset('/design-docs') }}/dist/libs/jsvectormap/dist/maps/world-merc.js?1667333929" defer></script>
    <!-- Tabler Core -->
    <script src="{{ asset('/design-docs') }}/dist/js/tabler.min.js?1667333929" defer></script>
    <script src="{{ asset('/design-docs') }}/dist/js/demo.min.js?1667333929" defer></script>
    <script src="{{ asset('/design-docs') }}/dist/js/snackbar.js"></script>
    @yield('script')
</body>

</html>
