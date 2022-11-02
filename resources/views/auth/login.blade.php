<x-guest-layout>
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="{{ route('home') }}" class="navbar-brand navbar-brand-autodark"><img
                                    src="{{ asset('/design-docs') }}/static/logo.svg" height="36" alt=""></a>
                        </div>
                        <div class="card card-md">
                            @if (!is_null(session('status')))
                                <x-alert type="important-success" icon="check-alert" text="{{session('status')}}"/>
                            @endif
                            <div class="card-body">
                                <h2 class="h2 text-center mb-4">Masuk untuk memulai Abseensi</h2>
                                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email"
                                            class="form-control @error('email')
                                            is-invalid
                                        @enderror"
                                            placeholder="Masukkan Email" autocomplete="off" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="form-label">
                                            Katasandi
                                            <span class="form-label-description">
                                                <a href="{{ route('password.request') }}">Lupa Katasandi</a>
                                            </span>
                                        </label>
                                        <div class="input-group input-group-flat">
                                            <input type="password"
                                                class="form-control @error('password')
                                                is-invalid
                                            @enderror"
                                                placeholder="Masukkan Katasandi" name="password" autocomplete="off">
                                            @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-check">
                                            <input type="checkbox" name="remember" class="form-check-input" />
                                            <span class="form-check-label">Ingat Saya</span>
                                        </label>
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary w-100">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg d-none d-lg-block">
                    <img src="{{ asset('/design-docs') }}/static/illustrations/undraw_secure_login_pdn4.svg"
                        height="300" class="d-block mx-auto" alt="">
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
