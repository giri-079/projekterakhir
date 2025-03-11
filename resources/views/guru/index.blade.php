<x-app-layout>
    <h1 class="text-center mb-4">Daftar Guru</h1>

    <div class="container">
        <a href="{{ route('guru.create') }}" class="btn btn-primary mb-3">Tambah Guru</a>

        <form action="{{ route('guru.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari ID/Nama..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-info">Cari</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Guru</th>
                    <th>Nama Guru</th>
                    <th>Status</th>
                    <th>Aksi</th>
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
                        <td>
                            <a href="{{ route('guru.edit', $guru->id_guru) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('guru.destroy', $guru->id_guru) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
