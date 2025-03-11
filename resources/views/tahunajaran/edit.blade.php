<x-app-layout>
    <h1 class="text-center mb-4">Edit Tahun Ajaran</h1>

    <div class="container">
        <!-- Menampilkan notifikasi alert jika ada -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('tahunajaran.update', $tahunAjaran->id_tahunajaran) }}" method="POST" onsubmit="showSuccessAlert()">
            @csrf
            @method('PUT')

            <!-- Tahun Ajaran -->
            <div class="form-group">
                <label for="tahun_ajaran">Tahun Ajaran:</label>
                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $tahunAjaran->tahun_ajaran) }}" required>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1" {{ $tahunAjaran->status == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $tahunAjaran->status == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>

    <script>
        function showSuccessAlert() {
            alert('Data Tahun Ajaran berhasil diperbarui!');
        }
    </script>
</x-app-layout>
