<x-app-layout>
    <h1 class="text-center mb-4">Daftar Guru</h1>

    <div class="container">
        <a href="{{ route('guru.create') }}" class="btn btn-primary mb-3">Tambah Guru</a>

        <form action="{{ route('guru.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari NIK/Nama Guru..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-info">Cari</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK Guru</th>
                    <th>Nama Guru</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th> <!-- Pusatkan judul kolom -->
                </tr>
            </thead>
            <tbody>
                @foreach ($gurus as $index => $guru)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $guru->id_guru }}</td>
                        <td>{{ $guru->nama_guru }}</td>
                        <td>
                            @if ($guru->status == 1)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group w-50 gap-2">
                                <a href="{{ route('guru.edit', $guru->id_guru) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                <form action="{{ route('guru.destroy', $guru->id_guru) }}" method="POST">
                                    
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
