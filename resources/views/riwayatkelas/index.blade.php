<x-app-layout>
    <h1 class="text-center mb-4">Daftar Riwayat Kelas</h1>

    <div class="container">
        {{-- <a href="{{ route('riwayatkelas.create') }}" class="btn btn-primary mb-3">Tambah Riwayat Kelas</a> --}}

        <form action="{{ route('riwayatkelas.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari NISN / Nama Siswa / Kelas..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-info">Cari</button>
            </div>
        </form>

        {{-- Flash Notifikasi SweetAlert --}}
        @if(session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: '{{ session("success") }}',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            </script>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th> {{-- Tambahan kolom NISN --}}
                    <th>Nama Siswa</th>
                    <th>Nama Kelas</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatKelas as $index => $riwayat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $riwayat->siswa->nisn ?? 'Tidak Diketahui' }}</td> {{-- Menampilkan NISN --}}
                    <td>{{ $riwayat->siswa->nama ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $riwayat->kelas->nama_kelas ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $riwayat->tahunAjaran->tahun_ajaran ?? 'Tidak Diketahui' }}</td>
                    <td>
                        @if ($riwayat->status == 1)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        {{-- <form action="{{ route('riwayatkelas.destroy', $riwayat->id_riwayatkelas) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event);">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm tombol-hapus">Hapus</button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $riwayatKelas->links() }}
        </div>
    </div>

    {{-- SweetAlert2 Hapus Konfirmasi --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }
    </script>

    <style>
        /* Menyesuaikan ukuran tombol hapus */
        .tombol-hapus {
            padding: 4px 8px !important;
            font-size: 12px !important;
        }
    </style>
</x-app-layout>
