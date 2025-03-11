<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Data Siswa') }}
        </h2>
    </x-slot>

    <div class="container">
        <!-- Menampilkan Notifikasi Sukses/Gagal -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Pencarian -->
        <form action="{{ route('siswa.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Nama/NISN..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-info">Cari</button>
            </div>
        </form>

        <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3">Tambah Data Siswa</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($siswa as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nisn }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->tempatlahir }}</td>
                        <td>{{ $item->tgllahir }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            <a href="{{ route('siswa.edit', ['id' => $item->nisn]) }}" class="btn btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('siswa.destroy', ['id' => $item->nisn]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
