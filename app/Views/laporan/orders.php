<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<h4 class="mb-0">Laporan Orderan</h4>
<p class="text-muted">Rekap berdasarkan Periode bulan</p>

<div class="card mb-3">
    <div class="card-body">
        <form action="<?= base_url('laporan/orders') ?>" class="g-3" method="get">
            <div class="col-md-3">
                <label class="form-label">Bulan</label>
                <input type="month" class="form-control" name="periode" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Tampilkan</button>
            </div>
        </form> 
    </div>
</div>

<div class="table-responsive">
          <table class="table table-hover table-bordered align-middle"> 
            <thead class="table-light">
              <tr>
                <th>No.</th>
                <th>No. Order</th>
                <th>Restaurant</th>
                <th>Driver</th>
                <th>Waktu Pemesanan</th>
                <th>Alamat</th>
                <th>Status</th>
              </tr>
            </thead>

            <tbody>
                <?php if(empty($laporan)): ?>
                <tr>
                  <td colspan="6" class="text-center text-muted">Belum Ada Data Menu.</td>
                </tr>
              <?php endif; ?>
              <?php foreach($laporan as $i => $row): ?>
                <tr>
                  <td><?= $i + 1; ?></td>
                  <td><?= esc($row['order_number']); ?></td>
                  <td><?= esc($row['restaurants_name']); ?></td>
                  <td><?= esc($row['drivers_name']); ?></td>
                  <td><?= date('d-m-Y', strtotime($row['order_time'])) ?></td> 
                  <td><?= esc($row['delivery_address']); ?></td>
                  <td><?= esc($row['status']); ?></td>
                  

                  </tr>

              <?php endforeach; ?>

              

            </tbody>
          </table>


<?= $this->endSection(); ?>