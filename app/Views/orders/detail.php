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

        <div class="mt-4">
            <?php if($header['status'] === 'Diproses') : ?>
            <form action="<?= base_url('orders/assignDriver/'.$header['orders_id']) ?>" method="post"> <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Pilih Driver</label>
                        <select name="driver_id" class="form-control" required>
                            <option value="">- Pilih Driver -</option>
                            <?php foreach($drivers as $d): ?>
                                <option value="<?= $d['driver_id'] ?>">
                                    <?= $d['name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-success">
                            Antarkan
                        </button>
                    </div>
                </div>
            </form>
            <?php endif ?>
            <?php if($header['status']==='Dikirim'): ?>
            <a href="<?= base_url('orders/cetak/'.$header['orders_id']) ?>" class="btn btn-info" target="_blank">
                Cetak
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>