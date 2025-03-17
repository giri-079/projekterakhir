<x-app-layout>
    <div class="container mt-4">
        <h1 class="text-center">Tambah Pengguna</h1>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST"> 
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    {{-- Username (Tambahan) --}}
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    {{-- NISN --}}
                    <div class="mb-3">
                        <label class="form-label">NISN</label>
                        <input type="text" name="nisn" id="nisn" class="form-control" required pattern="\d{10,}" 
                            title="NISN harus minimal 10 angka" oninput="validateNISN(this)">
                        <small class="text-danger d-none" id="nisnError">NISN harus minimal 10 angka</small>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <button type="button" class="btn btn-outline-secondary togglePassword" data-target="password">
                                <span class="eyeIcon">👁️</span>
                            </button>
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            <button type="button" class="btn btn-outline-secondary togglePassword" data-target="password_confirmation">
                                <span class="eyeIcon">👁️</span>
                            </button>
                        </div>
                    </div>

                    {{-- Role (Sesuai dengan Controller) --}}
                    <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select name="level" class="form-select" required>
                            <option value="guru">Guru</option>
                            <option value="siswa">Siswa</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-success" id="submitBtn">Simpan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk validasi NISN dan show/hide password --}}
    <script>
        function validateNISN(input) {
            let errorText = document.getElementById("nisnError");
            let submitButton = document.getElementById("submitBtn");
            let regex = /^\d{10,}$/; // Hanya angka, minimal 10 digit

            if (regex.test(input.value)) {
                errorText.classList.add("d-none");
                submitButton.disabled = false;
            } else {
                errorText.classList.remove("d-none");
                submitButton.disabled = true;
            }
        }

        document.querySelectorAll(".togglePassword").forEach(button => {
            button.addEventListener("click", function () {
                let inputField = document.getElementById(this.dataset.target);
                let eyeIcon = this.querySelector(".eyeIcon");

                if (inputField.type === "password") {
                    inputField.type = "text";
                    eyeIcon.innerHTML = "🙈"; // Mata tertutup
                } else {
                    inputField.type = "password";
                    eyeIcon.innerHTML = "👁️"; // Mata terbuka
                }
            });
        });
    </script>
</x-app-layout>
