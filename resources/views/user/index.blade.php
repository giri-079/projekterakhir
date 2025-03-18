<x-app-layout>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Daftar Pengguna</h1>

        {{-- Notifikasi Alert --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="🔍 Cari pengguna...">
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User</a>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead style="background-color: #7fcaef; color: black;">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th> <!-- Sesuai dengan database -->
                    <th>Level</th> <!-- Menampilkan role -->
                    <th>Tanggal Dibuat</th> <!-- Format created_at -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="userTable">
                @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username ?? '-' }}</td> <!-- Sesuai database -->
                        <td>{{ ucfirst($user->level) }}</td> <!-- Format level -->
                        <td>{{ $user->created_at ? $user->created_at->format('d-m-Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('user.password.edit', $user->id) }}" class="btn btn-secondary btn-sm">Ubah Password</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>    
        </table>
    </div>

    {{-- JavaScript untuk fitur pencarian --}}
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#userTable tr");

            rows.forEach(row => {
                let name = row.cells[1].textContent.toLowerCase();
                let email = row.cells[2].textContent.toLowerCase();
                let username = row.cells[3].textContent.toLowerCase();
                let role = row.cells[4].textContent.toLowerCase();
                row.style.display = (name.includes(filter) || email.includes(filter) || username.includes(filter) || role.includes(filter)) ? "" : "none";
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
