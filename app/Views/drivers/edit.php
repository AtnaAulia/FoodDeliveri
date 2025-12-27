<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Update Drivers</h4>
    <a href="<?= base_url('drivers') ?>" class="btn btn-secondary btn-sm">
        <i class="mdi mdi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('drivers/update/' . $driver['driver_id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Name Drivers</label>
                <input type="text" name="name" class="form-control" value="<?= esc($driver['name']) ?>" required>
            </div> 

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="number" name="phone" class="form-control" value="<?= esc($driver['phone']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Vehicle Plate</label>
                    <input type="text" name="vehicle_plate" class="form-control"    value="<?= esc($driver['vehicle_plate']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                    <select class="form-control" name="status">
                      <option value="available" <?= $driver['status']=='available'?'selected':'' ?>>Available</option>
                      <option value="busy" <?= $driver['status']=='busy'?'selected':'' ?>>Busy</option>
                      <option value="offline" <?= $driver['status']=='offline'?'selected':'' ?>>Offline</option>
                    </select>
            </div>


            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="<?= base_url('drivers') ?>" class="btn btn-outline-secondary">Batal</a>
        </form>    
    </div>
</div>

<?= $this->endSection(); ?>
