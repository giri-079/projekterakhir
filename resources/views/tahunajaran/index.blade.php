<x-app-layout>
    <h1 class="text-center mb-4">Daftar Tahun Ajaran</h1>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('tahunajaran.create') }}" class="btn btn-primary mb-3">Tambah Tahun Ajaran</a>

        <form action="{{ route('tahunajaran.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari ID/Tahun Ajaran..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-info">Cari</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Tahun Ajaran</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tahunajaran as $index => $Tahunajaran)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $Tahunajaran->id_tahunajaran }}</td>
                        <td>{{ $Tahunajaran->tahun_ajaran }}</td>
                        <td>
                            @if ($Tahunajaran->status)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('tahunajaran.edit', ['tahunajaran' => $Tahunajaran->id_tahunajaran]) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <form action="{{ route('tahunajaran.destroy', $Tahunajaran->id_tahunajaran) }}" method="POST" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $tahunajaran->links() }}
        </div>
    </div>

    <script>
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                event.target.submit();
            }
        }
    </script>
</x-app-layout>