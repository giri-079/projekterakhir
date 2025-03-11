<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center my-4">Edit Data Siswa</h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('siswa.update', $siswa->nisn) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- NISN (readonly) -->
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" name="nisn" value="{{ $siswa->nisn }}" required 
                                    class="form-control" readonly>
                            </div>

                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" value="{{ $siswa->nama }}" required 
                                    class="form-control">
                            </div>

                            <!-- Tempat Lahir -->
                            <div class="mb-3">
                                <label for="tempatlahir" class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempatlahir" value="{{ $siswa->tempatlahir }}" required 
                                    class="form-control">
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="tgllahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgllahir" value="{{ $siswa->tgllahir }}" required 
                                    class="form-control">
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" required class="form-control">{{ $siswa->alamat }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary ms-2">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
