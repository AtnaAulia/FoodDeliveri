<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<?php 
    $currentPage = $pager->getCurrentPage('drivers');
    $perPage = $perPage ?? 5;
    $noAwal = 1 + ($perPage * ($currentPage - 1));
?>

<div class="page-header">
  <h3 class="page-title">Drivers</h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Master Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Drivers</li>
    </ol>
  </nav>
</div>


<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="col">
            <h4 class="card-title mb-0">Data Driver's</h4>
          </div>
          <div class="col-auto">
            <form class="input-group btn-md m-8" action="<?= base_url('drivers'); ?>" method="get">
                <div class="input-group-prepend">
                    <div class="input-group-text mdi mdi-magnify"></div>
                </div>
                   <input type="text" name="keyword" class="form-control" value="<?= $keyword ?? '' ?>">
            </form>
          </div>
          <a href="<?= base_url('drivers/create'); ?>" class="btn btn-primary m-1">
            <i class="mdi mdi-plus-circle"></i> Tambah Driver
          </a>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle"> 
            <thead class="table-light">
              <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>vehicle Plate</th>
                  <th>Status</th>
                  <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($drivers as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1; ?></td>
                            <td><?= esc($row['name']); ?></td>
                            <td><?= esc($row['phone']); ?></td>
                            <td><?= esc($row['vehicle_plate']); ?></td>
                            <td>
                              <?php 
                                $status = esc($row['status']);
                                if ($status == 'Online') {
                                  echo '<span class="badge badge-success" style="border-radius: 20px; padding: 5px 15px;">Online</span>';
                                } elseif ($status == 'Offline') {
                                  echo '<span class="badge badge-danger" style="border-radius: 20px; padding: 5px 15px;">Offline</span>';
                                } elseif ($status == 'Busy') {
                                  echo '<span class="badge badge-warning text-white" style="border-radius: 20px; padding: 5px 15px;">Busy</span>';
                                } else {
                                  echo '<span class="badge badge-secondary" style="border-radius: 20px; padding: 5px 15px;">' . $status . '</span>';
                                }
                              ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('drivers/edit/' . $row['driver_id']); ?>" class="text-warning me-3"  title="Edit">
                                  <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= base_url('drivers/delete/' . $row['driver_id']); ?>" class="text-danger" title="Hapus" onclick="return confirm('Yakin Hapus Data?')">
                                  <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                <?php endforeach; ?>
                <?php if(empty($drivers)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum Ada Data Anggota.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
          </table>
          <div class="mt-3">
                <?= $pager->links('drivers', 'bootstrap'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>