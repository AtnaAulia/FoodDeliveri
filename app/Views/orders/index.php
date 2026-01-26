<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<?php 
  $currentPage = $pager->getCurrentPage('orders');
  $perPage = $perPage ?? 5;
  $noAwal = 1 + ($perPage * ($currentPage - 1));
?>

<div class="page-header">
  <h3 class="page-title">Order</h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Master Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Order</li>
    </ol>
  </nav>
</div>


<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="col">
            <h4 class="card-title mb-0">Data Order's</h4>
          </div>
          <div class="col-auto">
            <form class="input-group btn-md m-8" action="<?= base_url('orders'); ?>" method="get">
                <div class="input-group-prepend">
                  <div class="input-group-text mdi mdi-magnify"></div>
                </div>
                <input type="text" name="keyword" class="form-control" value="<?= $keyword ?? '' ?>">
            </form>
          </div>
          <a href="<?= base_url('orders/create'); ?>" class="btn btn-primary m-1">
            <i class="mdi mdi-plus-circle"></i> Tambah Orderan
          </a>
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
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php $no = $noAwal; ?>
              <?php foreach($orders as $i => $row): ?>
                <tr>
                  <td><?= $i + 1; ?></td>
                  <td><?= esc($row['order_number']); ?></td>
                  <td><?= esc($row['restaurants_name']); ?></td>
                  <td><?= esc($row['drivers_name']); ?></td>
                  <td><?= esc($row['order_time']); ?></td>
                  <td><?= esc($row['delivery_address']); ?></td>
                  <td>
                    <?php if($row['status'] === 'Selesai'): ?>
                      <span class="badge bg-success" style="border-radius: 20px; padding: 5px 15px;">Selesai</span>
                    <?php else: ?>
                      <span class="badge bg-warning" style="border-radius: 20px; padding: 5px 15px;">Diproses</span>
                    <?php endif; ?>
                  <td>
                    <a href="<?= base_url('orders/detail/'.$row['orders_id']) ?>" class="btn btn-sm btn-info">
                      Detail
                    </a>

                    <?php if($row['status'] === 'Dikirim'): ?>
                    <a href="<?= base_url('orders/selesai/'.$row['orders_id']) ?>" class="btn btn-sm btn-success"onclick="return confirm('Selesaikan pesanan ini?')">
                      Selesai
                    </a>
                    <?php endif; ?>
                  </td>

                  </tr>

              <?php endforeach; ?>

              <?php if(empty($orders)): ?>
                <tr>
                  <td colspan="7" class="text-center text-muted">Belum Ada Data Menu.</td>
                </tr>
              <?php endif; ?>

            </tbody>
          </table>
          <div class="mt-3">
            <?= $pager->links('orders', 'bootstrap'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>