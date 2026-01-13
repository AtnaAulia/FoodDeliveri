<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Tambah Menus</h4>
    <a href="<?= base_url('orders')?>" class="btn btn-secondary btn-sm">
         <i class="mdi mdi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body p-3">
    <div class="row mb-3">
        <div class="col-md-3">
             <label  class="form-label">NO. Orderan</label>
             <input type="text" class="form-control" value="<?= $header['order_number'] ?>">
        </div>
        <div class="col-md-3">
            <label  class="form-label">Alamat Pengiriman</label>
            <input type="text" class="form-control" value="<?= $header['delivery_address'] ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">Pelanggan</label>
            <input type="text" class="form-control" value="<?= $header['customers_name'] ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Drivers</label>
            <input type="text" class="form-control" value="<?= $header['drivers_name'] ?>">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label  class="form-label">Restaurant</label>
            <input type="text" class="form-control" value="<?= $header['restaurants_name'] ?>">
        </div>
    </div>

    <hr>
    <h6 class="mb-3">Daftar Menu yang Dipesan</h6>
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach($detail as $data) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['name'] ?></td>
                        <td><?= $data['qty'] ?></td>
                        <td><?= $data['price'] ?></td>
                        <td><?= $data['subtotal'] ?></td>
                    </tr>
                 <?php endforeach; ?>
            </tbody>
            <tr>
                <th colspan="4" class="text-center">Total Bayar</th>
                <td><?= $header['total_amount']; ?></td>
            </tr>
           
        </table>
    </div>
    <div class="mt-3">
        <?php if($header['status'] === 'Diproses') : ?>
            <a href="<?= base_url('orders/kirim/'. $header['orders_id']) ?>" class="btn btn-success" onclick="return confirm('Kembalikan Pinjaman?')">
                Antarkan
            </a>
        <?php elseif($header['status'] === 'Dikirim') : ?>
            <a href="<?= base_url('orders/selesai/'. $header['orders_id']) ?>" class="btn btn-success" onclick="return confirm('Kembalikan Pinjaman?')">
                Selesai
            </a>
        <?php endif; ?>
    </div>
</div>
</div>

<?= $this->endSection(); ?>