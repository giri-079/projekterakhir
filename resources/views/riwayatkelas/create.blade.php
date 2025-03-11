<x-app-layout>
    <h1 class="text-center mb-4">Tambah Riwayat Kelas</h1>

    <div class="container">
        <form action="{{ route('riwayatkelas.store') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="nisn" class="form-label">NISN Siswa</label>
                <select class="form-control" id="nisn" name="nisn" required>
                    <option value="">Pilih Siswa</option>
                    @foreach ($siswaList as $siswa)
                        <option value="{{ $siswa->nisn }}">{{ $siswa->nama }} - {{ $siswa->nisn }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_kelas" class="form-label">Nama Kelas</label>
                <select class="form-control" id="id_kelas" name="id_kelas" required>
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_tahunajaran" class="form-label">Tahun Ajaran</label>
                <select class="form-control" id="id_tahunajaran" name="id_tahunajaran" required>
                    <option value="">Pilih Tahun Ajaran</option>
                    @foreach ($tahunList as $tahun)
                        <option value="{{ $tahun->id_tahunajaran }}">{{ $tahun->tahun_ajaran }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <!-- Tombol Back -->
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</x-app-layout>
