<x-app-layout>
    <h1 class="text-center mb-4">Edit Data Izin Siswa</h1>

    <div class="container">
        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ route('izin.update', $izin->id_perizinan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama - NISN</th>
                            <td>
                                <input type="text" class="form-control" value="{{ $izin->siswa->nama }} - {{ $izin->nisn }}" disabled>
                                <input type="hidden" name="nisn" value="{{ $izin->nisn }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>
                                <select name="nama_kelas" id="nama_kelas" class="form-select" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->nama_kelas }}" {{ $izin->nama_kelas == $k->nama_kelas ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <td>
                                <select name="id_tahunajaran" class="form-select" required>
                                    <option value="">-- Pilih Tahun Ajaran --</option>
                                    @foreach ($tahun_ajaran as $tahunajaran)
                                        <option value="{{ $tahunajaran->id_tahunajaran }}" {{ $izin->id_tahunajaran == $tahunajaran->id_tahunajaran ? 'selected' : '' }}>
                                            {{ $tahunajaran->tahun_ajaran }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>
                                <select name="kategori" class="form-select" required>
                                    <option value="sakit" {{ $izin->kategori == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                    <option value="dispen" {{ $izin->kategori == 'dispen' ? 'selected' : '' }}>Dispen</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Alasan</th>
                            <td>
                                <textarea name="alasan" class="form-control" rows="3" required>{{ $izin->alasan }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Mulai</th>
                            <td>
                                <input type="datetime-local" name="tanggal_mulai_izin" class="form-control"
                                       value="{{ \Carbon\Carbon::parse($izin->tanggal_mulai_izin)->format('Y-m-d\TH:i') }}" required>
                            </td>
                        </tr>
                      
                        <tr>
                            <th>Bukti (Opsional)</th>
                            <td>
                                <input type="file" name="bukti" class="form-control" accept="image/jpeg,image/png,image/jpg">
                                @if ($izin->bukti)
                                    <p class="mt-2">Bukti Sebelumnya: <a href="{{ asset('storage/' . $izin->bukti) }}" target="_blank">Lihat Bukti</a></p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <select name="status" class="form-select" required>
                                    <option value="menunggu" {{ $izin->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="diizinkan" {{ $izin->status == 'diizinkan' ? 'selected' : '' }}>Diizinkan</option>
                                    <option value="ditolak" {{ $izin->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </td>
                        </tr>
                    </table>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        <a href="{{ route('izin.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
