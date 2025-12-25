<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

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
          <h4 class="card-title mb-0">Data Driver's</h4>
          <a href="<?= base_url('drivers/create'); ?>" class="btn btn-primary btn-sm">
            Tambah Driver
          </a>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle"> 
            <thead class="table-light">
              <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>vehicle_plate</th>
                  <th>Status</th>
                  <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach($drivers as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1; ?></td>
                            <td><?= esc($row['name']); ?></td>
                            <td><?= esc($row['phone']); ?></td>
                            <td><?= esc($row['vehicle_plate']); ?></td>
                            <td><?= esc($row['status']); ?></td>
                            <td>
                                <a href="<?= base_url('drivers/edit/' . $row['driver_id']); ?>" class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <a href="<?= base_url('drivers/delete/' . $row['driver_id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus Data?')">
                                    Hapus
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
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>