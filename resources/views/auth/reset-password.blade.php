<x-guest-layout>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="card">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="card-body">
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
                        <div class="mb-3">
                            <label class="form-label">Katasandi baru</label>
                            <input type="password"
                                class="form-control @error('password')
                                is-invalid
                            @enderror"
                                name="password" required placeholder="Masukkan katasandi baru">
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi katasandi baru</label>
                            <input type="password"
                                class="form-control @error('password_confirmation')
                                is-invalid
                            @enderror"
                                name="password_confirmation" required placeholder="Masukkan Konfirmasi katasandi baru">
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <x-icon type="lock" classicon="icon icon-alert" />
                                Reset katasandi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
