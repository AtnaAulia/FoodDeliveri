<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perusahaan</title>

    <!-- CSS Bootstarps 5 -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

     <style>
        body{
            background-color: #f5f5f5;
        }

        .login-wrapper{
            min-height: 100vh;
        }
        .login-card{
            max-width: 400px;
            width: 100%;
        }
     </style>
</head>
<body>
    
<div class="d-flex align-items-center justify-content-center login-wrapper">
    <div class="card shadow-sm login-card">
        <div class="card-body">
            <h5 class="card-title mb-1 text-center">Sistem Food Delivery</h5>
            <p class="text-mmuted text-center mb-4">Silahkan Login terlebih Dahulu</p>

            <!-- menampilkan pesan eror jika gagal login -->
            <?php if(session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label  class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username" value="<?= old('username') ?>" required>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                </div>

                <button class="btn btn-primary w-100">
                    Login
                </button>
            </form>
        </div>
        <div class="card-footer text-center small text-muted">
            &copy; <?= date('Y') ?>Perpustakaan
        </div>
    </div>
</div>

</body>
</html>