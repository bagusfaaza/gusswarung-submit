<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-5">

    <div class="container col-md-4">
        <h3 class="text-center mb-4">Register</h3>

        <form method="POST" action="{{ route('register.action') }}">
            @csrf

            {{-- Pesan error validasi (jika ada) --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Pesan sukses (dari controller) --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <input type="text" name="name" class="form-control mb-3 @error('name') is-invalid @enderror"
                placeholder="Nama" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <input type="email" name="email" class="form-control mb-3 @error('email') is-invalid @enderror"
                placeholder="bebas@role.com" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            {{-- PERUBAHAN UTAMA: Input Password dengan Toggle --}}
            <div class="input-group mb-3">
                <input type="password" name="password" id="passwordInput"
                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                        <path
                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                    </svg>
                </button>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- AKHIR PERUBAHAN UTAMA --}}

            <select name="role" class="form-control mb-3">
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="driver" {{ old('role') == 'driver' ? 'selected' : '' }}>Driver</option>
            </select>

            <button type="submit" class="btn btn-success w-100">Daftar</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function (e) {
                // Toggle antara 'password' dan 'text'
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Ganti ikon mata (dari 'eye-fill' ke 'eye-slash-fill' dan sebaliknya)
                if (type === 'text') {
                    // Tampilkan ikon mata tertutup (karena password sudah terlihat)
                    eyeIcon.setAttribute('d', 'M13.359 11.237q.276-.239.527-.487q.263-.263.504-.539l-.497-.497a.499.499 0 0 0-.001-.707l-.41-.41a.5.5 0 0 0-.707 0L8 10.155l-2.753-2.753a.5.5 0 0 0-.707 0L4.13 8.358a.499.499 0 0 0-.001.707L5.51 9.957q-.276.239-.527.487q-.263.263-.504.539l.497.497a.499.499 0 0 0 .707 0l4.243-4.243 2.753 2.753a.5.5 0 0 0 .707 0l.41-.41a.5.5 0 0 0 0-.707zM8 3.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7zM8 2a5.5 5.5 0 0 1 5.475 4.502c.002.096.002.193 0 .298A16.03 16.03 0 0 1 16 8s-3 5.5-8 5.5S0 8 0 8a16.03 16.03 0 0 1 2.525-3.201.5.5 0 0 0-.001.707L.13 8.358a.499.499 0 0 0-.001.707L5.51 9.957q-.276.239-.527.487q-.263.263-.504.539l.497.497a.499.499 0 0 0 .707 0l4.243-4.243 2.753 2.753a.5.5 0 0 0 .707 0l.41-.41a.5.5 0 0 0 0-.707z');
                    eyeIcon.setAttribute('fill', 'red'); // Opsional: Berikan warna berbeda
                } else {
                    // Tampilkan ikon mata terbuka (karena password tersembunyi)
                    eyeIcon.setAttribute('d', 'M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0zM0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z');
                    eyeIcon.setAttribute('fill', 'currentColor');
                }

                // Fokuskan kembali pada input setelah diklik
                passwordInput.focus();
            });
        });
    </script>

</body>

</html>