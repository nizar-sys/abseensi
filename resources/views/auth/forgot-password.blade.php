<x-guest-layout>
    {{-- <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card> --}}
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36"
                        alt=""></a>
            </div>
            <form class="card card-md" action="./" method="get" autocomplete="off" novalidate>
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Lupa katasandi</h2>
                    <p class="text-muted mb-4">Masukkan alamat email Anda dan kata sandi Anda akan diatur ulang dan
                        dikirim melalui email ke
                        Anda.</p>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Masukkan email">
                    </div>
                    <div class="form-footer">
                        <a href="#" class="btn btn-primary w-100">
                            <x-icon type="email" classicon="" />
                            Kirimi saya katasandi baru
                        </a>
                    </div>
                </div>
            </form>
            <div class="text-center text-muted mt-3">
                Lupakan, <a href="{{ route('login') }}">kembali</a> ke halaman masuk.
            </div>
        </div>
    </div>
</x-guest-layout>
