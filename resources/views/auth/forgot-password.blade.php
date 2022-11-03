<x-guest-layout>
    <div class="page page-center">
        <div class="container container-tight py-4">
            @if (session()->has('status'))
                <x-alert type="important-success" icon="check-alert" :text="session('status')" />
            @endif
            <div class="card">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Lupa katasandi</h2>
                        <p class="text-muted mb-4">Masukkan alamat email Anda dan kata sandi Anda akan diatur ulang dan
                            dikirim melalui email ke
                            Anda.</p>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                class="form-control @error('email')
                                is-invalid
                            @enderror"
                                name="email" required placeholder="Masukkan email">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <x-icon type="email" classicon="" />
                                Kirimi saya katasandi baru
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted mt-3 mb-3">
                    Lupakan, <a href="{{ route('login') }}">kembali</a> ke halaman masuk.
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
