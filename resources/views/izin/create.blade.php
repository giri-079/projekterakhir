<x-app-layout>
    <h1 class="text-center mb-4">Tambah Izin Siswa</h1>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN</label>
                        <select name="nisn" id="nisn" class="form-select" required>
                            <option value="">-- Pilih NISN SISWA --</option>
                            @foreach ($siswa as $s)
                                <option value="{{ $s->nisn }}" 
                                        data-kelas="{{ $s->kelas }}" 
                                        data-tahun="{{ $s->tahun_ajaran }}">
                                    {{ $s->nisn }} - {{ $s->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <select name="id_kelas" id="kelas" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                    
                    

                    <div class="mb-3">
                        <label for="id_tahunajaran" class="form-label">Tahun Ajaran</label>
                        <select name="id_tahunajaran" id="tahun_ajaran" class="form-select" required>
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            @foreach ($tahunajaran as $ta)
                                <option value="{{ $ta->id_tahunajaran }}">{{ $ta->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="alasan" class="form-label">Alasan</label>
                        <input type="text" name="alasan" class="form-control" required maxlength="255">
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori Izin</label>
                        <select name="kategori" class="form-select" required>
                            <option value="sakit">Sakit</option>
                            <option value="dispen">Dispen</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_mulai_izin" class="form-label">Tanggal Mulai Izin</label>
                        <input type="datetime-local" name="tanggal_mulai_izin" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_akhir_izin" class="form-label">Tanggal Akhir Izin</label>
                        <input type="datetime-local" name="tanggal_akhir_izin" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="bukti" class="form-label">Upload Bukti</label>
                        <input type="file" name="bukti" class="form-control" accept="image/jpeg,image/png,image/jpg">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="menunggu" selected>Menunggu</option>
                            <option value="diizinkan">Diizinkan</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('izin.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('nisn').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let kelas = selectedOption.getAttribute('data-kelas');
            let tahun = selectedOption.getAttribute('data-tahun');

            document.getElementById('kelas').value = kelas ? kelas : "";
            document.getElementById('tahun_ajaran').value = tahun ? tahun : "";
        });
    </script>
</x-app-layout>
