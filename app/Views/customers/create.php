<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3 m-3">
    <h4 class="mb-0">Tambah Customers</h4>
    <a href="<?= base_url('customers'); ?>" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('customers/insert'); ?>" method="post">
            <?= csrf_field() ?>
            <!-- Nama Anggota -->
             <div class="mb-3">
                <label class="form-label">Nama Customer</label>
                <input type="text" name="name" class="form-control" required>
             </div>
             <div class="mb-3">
                <label class="form-label">Phone Customer</label>
                <input type="text" name="phone" class="form-control" required>
             </div>
            <!-- Email -->
             <div class="mb-3">
                <label class="form-label">Email Customer</label>
                <input type="text" name="email" class="form-control" required>
             </div>
            <!-- Alamat -->
             <div class="mb-3">
                <label class="form-label">Alamat Customer</label>
                <input type="text" name="address" class="form-control" required>
             </div>

            <!-- Tombol simpan dan reset -->
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>

        </form>  
    </div>     
</div>
<?= $this->endSection(); ?>