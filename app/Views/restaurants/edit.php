<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Update Restaurants</h4>
    <a href="<?= base_url('restaurants') ?>" class="btn btn-secondary btn-sm">
        <i class="mdi mdi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('restaurants/update/' . $restaurants['restaurants_id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Name Restaurants</label>
                <input type="text" name="name" class="form-control" value="<?= esc($restaurants['name']) ?>" required>
            </div> 

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="number" name="phone" class="form-control" value="<?= esc($restaurants['phone']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="<?= esc($restaurants['address']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Opening Hours</label>
                <input type="text" name="opening_hours" class="form-control" value="<?= esc($restaurants['opening_hours']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                    <select class="form-control" name="status" class="form-select" value="<?= $restaurants['status'] ?>">
                      <option value="Beroperasi" <?= $restaurants['status']=='Beroperasi'?'selected':'' ?>>Beroperasi</option>
                      <option value="Tutup" <?= $restaurants['status']=='Tutup'?'selected':'' ?>>Tutup</option>
                      <option value="Istirahat" <?= $restaurants['status']=='Istirahat'?'selected':'' ?>>Istirahat</option>
                    </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="<?= base_url('customers') ?>" class="btn btn-outline-secondary">Batal</a>
        </form>    
    </div>
</div>

<?= $this->endSection(); ?>
