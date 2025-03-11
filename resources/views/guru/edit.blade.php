<x-app-layout>
    <h1 class="text-center mb-4">Edit Guru</h1>

    <div class="container">
        <form action="{{ route('guru.update', $guru->id_guru) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- ID Guru (Tidak dapat diubah) -->
            <div class="form-group">
                <label for="id_guru">ID Guru:</label>
                <input type="text" class="form-control" name="id_guru" value="{{ $guru->id_guru }}" readonly required>
            </div>

            <!-- Nama Guru -->
            <div class="form-group">
                <label for="nama_guru">Nama Guru:</label>
                <input type="text" class="form-control" name="nama_guru" value="{{ $guru->nama_guru }}" required>
            </div>

            <!-- Status -->
            {{-- <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" class="form-control" name="status" value="{{ $guru->status }}" required>
            </div> --}}

            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1" {{ $guru->status == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $guru->status == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            

            <button type="submit" class="btn btn-success mt-3">Update</button>
        </form>
    </div>
</x-app-layout>
