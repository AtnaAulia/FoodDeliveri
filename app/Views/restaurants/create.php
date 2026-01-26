<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3 m-3">
    <h4 class="mb-0">Add Restaurant</h4>
    <a href="<?= base_url('restaurants'); ?>" class="btn btn-secondary btn-sm">
        <i class="mdi mdi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('restaurants/insert'); ?>" method="post">
            <?= csrf_field() ?>
            <!-- Nama Restaurant -->
             <div class="mb-3">
                <label class="form-label">Restaurant Name</label>
                <input type="text" name="name" class="form-control" required>
             </div>
             <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="number" name="phone" class="form-control" required>
             </div>
            <!-- Email -->
             <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" required>
             </div>
            <!-- Alamat -->
             <div class="mb-3">
                <label class="form-label">Opening Hours</label>
                <input type="text" name="opening_hours" class="form-control" required>
             </div>

            <!-- Tombol simpan dan reset -->
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>

        </form>  
    </div>     
</div>
<?= $this->endSection(); ?>