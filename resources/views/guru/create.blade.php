<x-app-layout>
    <h1 class="text-center mb-4">Tambah Guru</h1>

    <div class="container">
        <form action="{{ route('guru.store') }}" method="POST">
            @csrf

            <!-- ID Guru -->
            <div class="form-group">
                <label for="id_guru">NIK Guru:</label>
                <input type="text" 
                       class="form-control @error('id_guru') is-invalid @enderror" 
                       name="id_guru" 
                       id="id_guru"
                       value="{{ old('id_guru') }}" 
                       required 
                       pattern="\d{10}" 
                       title="ID Guru harus tepat 10 angka">

                <!-- Pesan error dari Laravel -->
                @error('id_guru')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <!-- Pesan error dari JavaScript -->
                <small class="text-danger d-none" id="id_guru_error">ID Guru harus tepat 10 angka</small>
            </div>

            <!-- Nama Guru -->
            <div class="form-group">
                <label for="nama_guru">Nama Guru:</label>
                <input type="text" class="form-control" name="nama_guru" value="{{ old('nama_guru') }}" required>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" name="status" required>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>

    <script>
        document.getElementById('id_guru').addEventListener('input', function () {
            let input = this;
            let errorText = document.getElementById('id_guru_error');

            if (input.value.length !== 10 || isNaN(input.value)) {
                input.classList.add('is-invalid');
                errorText.classList.remove('d-none');
            } else {
                input.classList.remove('is-invalid');
                errorText.classList.add('d-none');
            }
        });
    </script>
</x-app-layout>
