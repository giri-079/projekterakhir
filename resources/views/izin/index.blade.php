<x-app-layout>
    <h1 class="text-center mb-4">Daftar Izin Siswa</h1>

    <div class="container">
        <a href="{{ route('izin.create') }}" class="btn btn-primary mb-3">Tambah Izin Siswa</a>

        {{-- Form Pencarian --}}
        <form action="{{ route('izin.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari NISN / Alasan..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-info">Cari</button>
            </div>
        </form>

        {{-- Tabel Data Izin --}}
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 10%;">NISN</th>
                    <th style="width: 15%;">Nama</th>
                    <th style="width: 10%;">Kelas</th>
                    <th style="width: 12%; white-space: nowrap;">Tahun Ajaran</th>
                    <th style="width: 15%;">Alasan</th>
                    <th style="width: 10%;">Kategori</th>
                    <th style="width: 10%; white-space: nowrap;">Tanggal Mulai</th>
                    <th style="width: 10%; white-space: nowrap;">Tanggal Akhir</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 10%;">Bukti</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($izin as $index => $izinItem)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $izinItem->nisn }}</td>
                    <td>{{ $izinItem->siswa->nama ?? 'Tidak ada data' }}</td>
                    <td>{{ $izinItem->kelas->nama_kelas ?? 'Tidak ada data' }}</td>
                    <td><strong>{{ $izinItem->tahunajaran->tahun_ajaran ?? 'Tidak ada data' }}</strong></td>
                    <td>{{ $izinItem->alasan }}</td>
                    <td>{{ ucfirst($izinItem->kategori) }}</td>
                    <td style="white-space: nowrap;">
                        {{ \Carbon\Carbon::parse($izinItem->tanggal_mulai_izin)->format('d M Y - H:i') }}
                    </td>
                    <td style="white-space: nowrap;">
                        {{ \Carbon\Carbon::parse($izinItem->tanggal_akhir_izin)->format('d M Y - H:i') }}
                    </td>
                    <td>
                        <span class="badge bg-{{ $izinItem->status == 'diizinkan' ? 'success' : ($izinItem->status == 'menunggu' ? 'warning' : 'danger') }}">
                            {{ ucfirst($izinItem->status) }}
                        </span>
                    </td>
                    <td>
                        @if ($izinItem->bukti)
                            <img src="{{ asset('storage/' . $izinItem->bukti) }}" 
                                 alt="Bukti Izin" 
                                 style="max-width: 120px; height: auto; cursor: pointer; border-radius: 5px;"
                                 onclick="showBukti('{{ asset('storage/' . $izinItem->bukti) }}')">
                        @else
                            <span class="text-muted">Tidak ada bukti</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('izin.edit', $izinItem->id_perizinan) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('izin.destroy', $izinItem->id_perizinan) }}" method="POST" onsubmit="return confirmDelete(event);">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- SweetAlert2 untuk gambar --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showBukti(imageUrl) {
            Swal.fire({
                imageUrl: imageUrl,
                imageWidth: 500,
                showCloseButton: true,
                showConfirmButton: false,
            });
        }

        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target;

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        // Notifikasi dari session
        @if(session('success'))
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: "Gagal!",
                text: "{{ session('error') }}",
                icon: "error",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
</x-app-layout>
