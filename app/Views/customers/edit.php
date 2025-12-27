<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Update Customers</h4>
    <a href="<?= base_url('customers') ?>" class="btn btn-secondary btn-sm">
        <i class="mdi mdi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
        <form action="<?= base_url('customers/update/' . $customer['customers_id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Name Customers</label>
                <input type="text" name="name" class="form-control" value="<?= esc($customer['name']) ?>" required>
            </div> 

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="number" name="phone" class="form-control" value="<?= esc($customer['phone']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= esc($customer['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="<?= esc($customer['address']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="<?= base_url('customers') ?>" class="btn btn-outline-secondary">Batal</a>
        </form>    
    </div>
</div>

<?= $this->endSection(); ?>
