<x-app-layout>
    <h1 class="text-center mb-4">Daftar Kelas</h1>

    <div class="container">
        <!-- Menampilkan notifikasi alert jika ada -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('kelas.create') }}" class="btn btn-primary mb-3">Tambah Kelas</a>

        <form action="{{ route('kelas.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Kelas..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-info">Cari</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Kelas</th>
                    <th>Nama Kelas</th>
                    <th>Wali Kelas</th> <!-- Hanya menampilkan nama guru -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelass as $index => $kelas)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kelas->id_kelas }}</td>
                        <td>{{ $kelas->nama_kelas }}</td>
                        <td>
                            @if($kelas->guru)
                                {{ $kelas->guru->nama_guru }}
                            @else
                                Guru tidak tersedia
                            @endif
                        </td>
                        <td>
                            <div class="btn-group gap-2">
                                <a href="{{ route('kelas.edit', $kelas->id_kelas) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('kelas.destroy', $kelas->id_kelas) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

<!-- Tambahkan Bootstrap dan jQuery jika menggunakan Bootstrap 4 -->
@if (!app()->environment('production'))
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endif 
