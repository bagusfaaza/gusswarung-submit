<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengaturan Profil - Gus Warung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #fffef8;
        }

        .settings-container {
            max-width: 700px;
            margin: 60px auto;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .settings-container h2 {
            font-weight: 700;
            color: #ffc107;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }

        .avatar-preview {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ffc107;
            margin-bottom: 10px;
        }

        .upload-btn {
            background-color: #ffc107;
            color: white;
            font-weight: 600;
            border-radius: 25px;
        }

        .upload-btn:hover {
            background-color: #ffc107;
        }
    </style>
</head>

<body>
    <div class="container settings-container">
        <h2 class="text-center mb-4">Pengaturan Profil</h2>

        <div class="text-center mb-4">
            <img id="avatarPreview" src="img/chef baguz.jpg" alt="Avatar" class="avatar-preview" />
            <div>
                <label for="avatar" class="upload-btn btn btn-sm mt-2">Upload Foto</label>
                <input type="file" id="avatar" accept="image/*" class="d-none" />
            </div>
        </div>

        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" placeholder="Rendy" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" placeholder="Putra" />
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="guswarung_admin" />
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" placeholder="+62 812 3456 7890" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kota</label>
                    <input type="text" class="form-control" placeholder="Surabaya" />
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="guswarung@email.com" />
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success fw-semibold rounded-pill py-2">
                    Simpan Perubahan
                </button>
                <div id="successMsg" class="alert alert-success mt-3 d-none" role="alert">
                    ✅ Perubahan berhasil disimpan!
                </div>
            </div>
        </form>
    </div>

    <script>
        // Preview foto avatar setelah upload
        document
            .getElementById("avatar")
            .addEventListener("change", function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        document.getElementById("avatarPreview").src =
                            event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
    </script>
</body>

</html>

<script>
    const form = document.querySelector("form");
    const successMsg = document.getElementById("successMsg");

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        successMsg.classList.remove("d-none"); // tampilkan pesan sukses
        successMsg.scrollIntoView({ behavior: "smooth" }); // scroll ke pesan
    });
</script>