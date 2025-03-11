<x-app-layout>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Tambah Siswa</h1>

                        <!-- Form untuk menambah data siswa -->
                        <form action="{{ route('siswa.store') }}" method="POST">
                            @csrf

                            <table class="table table-bordered">
                                <tbody>
                                    <!-- NISN -->
                                    <tr>
                                        <td><label for="nisn">NISN:</label></td>
                                        <td>
                                            <input type="text" name="nisn" id="nisn" class="form-control" pattern="\d{10}" 
                                                title="NISN harus terdiri dari 10 digit" value="{{ old('nisn') }}" required>
                                        </td>
                                    </tr>

                                    <!-- Nama -->
                                    <tr>
                                        <td><label for="nama">Nama:</label></td>
                                        <td>
                                            <input type="text" class="form-control" value="{{ old('nama') }}" name="nama" id="nama" required>
                                        </td>
                                    </tr>

                                    <!-- Tempat Lahir -->
                                    <tr>
                                        <td><label for="tempat_lahir">Tempat Lahir:</label></td>
                                        <td>
                                            <input type="text" class="form-control" value="{{ old('tempatlahir') }}" name="tempatlahir" id="tempat_lahir" required>
                                        </td>
                                    </tr>

                                    <!-- Tanggal Lahir -->
                                    <tr>
                                        <td><label for="tanggal_lahir">Tanggal Lahir:</label></td>
                                        <td>
                                            <input type="date" class="form-control" value="{{ old('tgllahir') }}" name="tgllahir" id="tanggal_lahir" required>
                                        </td>
                                    </tr>

                                    <!-- Alamat -->
                                    <tr>
                                        <td><label for="alamat">Alamat:</label></td>
                                        <td>
                                            <textarea class="form-control" value="{{ old('alamat') }}" name="alamat" id="alamat" rows="4" required></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Tombol Submit dan Kembali -->
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
