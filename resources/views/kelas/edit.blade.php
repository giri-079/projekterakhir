<x-app-layout>
    <h1 class="text-center mb-4">Edit Kelas</h1>

    <div class="container">
        <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- ID Guru (Tidak dapat diubah) -->
            <div class="form-group">
                <label for="id_kelas">ID Kelas:</label>
                <input type="text" class="form-control" name="id_kelas" value="{{ $kelas->id_kelas }}" readonly required>
            </div>

            <!-- Nama Guru -->
            <div class="form-group">
                <label for="nama_kelas">Nama Kelas:</label>
                <input type="text" class="form-control" name="nama_kelas" value="{{ $kelas->nama_kelas }}" required>
            </div>

            {{-- <div class="form-group">
                <label for="id_guru">NISN Guru:</label>
                <input type="text" class="form-control" name="id_guru" value="{{ $kelas->id_guru }}" required>
            </div> --}}

            <tr>
                <td><label for="id_guru">Wali Kelas </label></td>
                <td>
                    <select name="id_guru" id="id_guru" class="form-control" required>
                        <option value="">-- Pilih Wali Kelas - NISN --</option>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->id_guru }}" 
                                {{ old('id_guru') == $guru->id_guru ? 'selected' : '' }}>
                                {{ $guru->nama_guru }} - {{ $guru->id_guru }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <button type="submit" class="btn btn-success mt-3">Update</button>
        </form>
    </div>
</x-app-layout>
