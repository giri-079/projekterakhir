<x-app-layout>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Tambah Kelas</h1>

                        <!-- Form untuk menambah data kelas -->
                        <form action="{{ route('kelas.store') }}" method="POST">
                            @csrf

                            <table class="table table-bordered">
                                <tbody>
                                    <!-- ID Kelas -->
                                    <tr>
                                        <td><label for="id_kelas">ID Kelas:</label></td>
                                        <td>
                                            <input type="text" name="id_kelas" id="id_kelas" class="form-control" 
                                                value="{{ old('id_kelas') }}" required>
                                        </td>
                                    </tr>

                                    <!-- Nama Kelas -->
                                    <tr>
                                        <td><label for="nama_kelas">Nama Kelas:</label></td>
                                        <td>
                                            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" 
                                                value="{{ old('nama_kelas') }}" required>
                                        </td>
                                    </tr>

                                    <!-- Wali Kelas-->
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
                                </tbody>
                            </table>

                            <!-- Tombol Submit dan Kembali -->
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('kelas.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
