<x-app-layout>
    <h1 class="text-center mb-4">Tambah Tahun Ajaran</h1>

    <div class="container">
        <form action="{{ route('tahunajaran.store') }}" method="POST">
            @csrf

            <!-- Tahun Ajaran -->
            <div class="form-group">
                <label for="tahun_ajaran">Tahun Ajaran:</label>
                <input type="text" class="form-control" name="tahun_ajaran" value="{{ old('tahun_ajaran') }}" required>
            </div>

            <!-- Status (Dropdown) -->
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" name="status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option> <!-- Perbaiki nama value -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</x-app-layout>
