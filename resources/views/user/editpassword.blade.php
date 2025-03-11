<x-app-layout>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Reset Password</h1>

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Notifikasi Kesalahan --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Periksa kembali data yang Anda masukkan.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-body">
                <form action="{{ route('user.password.update', $user->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Ubah Password Baru</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    {{-- Bootstrap Script agar tombol Close berfungsi --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
