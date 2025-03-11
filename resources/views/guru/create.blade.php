<x-app-layout>
    <h1 class="text-center mb-4">Tambah Guru</h1>

    <div class="container">
        <form action="{{ route('guru.store') }}" method="POST">
            @csrf

            <!-- ID Guru (Sekarang bisa diisi) -->
            <div class="form-group">
                <label for="id_guru">ID Guru:</label>
                <input type="text" class="form-control" name="id_guru" value="{{ old('id_guru') }}" required>
            </div>

            <!-- Nama Guru -->
            <div class="form-group">
                <label for="nama_guru">Nama Guru:</label>
                <input type="text" class="form-control" name="nama_guru" value="{{ old('nama_guru') }}" required>
            </div>

            <!-- Status (Dropdown) -->
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" name="status" required>
                    <option value="1" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</x-app-layout>
