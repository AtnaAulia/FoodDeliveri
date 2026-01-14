<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<?php 
    $currentPage = $pager->getCurrentPage('menus');
    $perPage = $perPage ?? 5;
    $noAwal = 1 + ($perPage * ($currentPage - 1));
?>

<div class="page-header">
  <h3 class="page-title">Menus</h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Master Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Menus</li>
    </ol>
  </nav>
</div>


<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="col">
            <h4 class="card-title mb-0">Data Menu's</h4>
          </div>
          <div class="col-auto">
            <form class="input-group btn-md m-8" action="<?= base_url('menus'); ?>" method="get">
                <div class="input-group-prepend">
                    <div class="input-group-text mdi mdi-magnify"></div>
                </div>
                   <input type="text" name="keyword" class="form-control" value="<?= $keyword ?? '' ?>">
            </form>
          </div>
          <a href="<?= base_url('menus/create'); ?>" class="btn btn-primary m-1">
            <i class="mdi mdi-plus-circle"></i> Tambah Menu
          </a>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle"> 
            <thead class="table-light">
              <tr>
                <th>No.</th>
                <th>Restaurant Name</th>
                <th>Name</th>
                <th>Cover</th>
                <th>Description</th>
                <th>Price</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php $no = $noAwal; ?>
              <?php foreach($menus as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1; ?></td>
                            <td><?= esc($row['restaurants_name']); ?></td>
                            <td><?= esc($row['name']); ?></td>
                            <td class="text-center">
                                <?php if (!empty($row['cover'])) : ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalCover<?= $row['menus_id'] ?>">
                                        Lihat
                                    </button>
                                <?php else : ?>
                                    <span class="text-muted"> - </span>
                                <?php endif ?>
                            </td>
                            <td><?= esc($row['description']); ?></td>
                            <td>Rp<?= number_format($row['price'],0,',','.') ; ?></td>
                            <td>
                              <?php 
                                $status = esc($row['is_available']);
                                if ($status == 'Yes') {
                                  echo '<span class="badge badge-success" style="border-radius: 20px; padding: 5px 15px;">Available</span>';
                                } elseif ($status == 'No') {
                                  echo '<span class="badge badge-danger" style="border-radius: 20px; padding: 5px 15px;">Not Available</span>';
                                } else {
                                  echo '<span class="badge badge-secondary" style="border-radius: 20px; padding: 5px 15px;">' . $status . '</span>';
                                }
                              ?>
                            </td> 
                            <td>
                               <a href="<?= base_url('menus/edit/' . $row['menus_id']); ?>" class="text-warning me-3"  title="Edit">
                                  <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="javascript:void(0)" class="text-danger btn-delete" data-url="menus/delete/<?= $row['menus_id']; ?>" title="Hapus">
                                  <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php if (!empty($row['cover'])) : ?>
                            <!-- Modal untuk cover -->
                             <div class="modal fade" id="modalCover<?= $row['menus_id'] ?>" tabindex="-1" aria-labelledby="modalCoverLabel<?= $row['menus_id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCoverLabel<?= $row['menus_id']?>">
                                                <?= $row['name']; ?>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    
                                        <div class="modal-body text-center">
                                            <img src="<?= base_url('image/cover/'.$row['cover']) ?>" alt="Cover <?= $row['name'] ?>" class="img-fluid rounded" >
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php endforeach; ?>
                        <?php if(empty($menus)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum Ada Data Menu.</td>
                            </tr>
                        <?php endif; ?>
            </tbody>
          </table>
          <div class="mt-3">
                <?= $pager->links('drivers', 'bootstrap'); ?>
          </div>
          <!-- MODAL DELETE -->
          <div id="deleteModal" class="modal-overlay">
            <div class="modal-box">

              <h4>Hapus Data Customer</h4>
              <div class="modal-gif">
                <!-- PR TEST POP-UP -->
                <img class="center" src="<?= base_url('assets/images/delete.gif'); ?>" alt="Warning">
              </div>

              <p class="text-muted">Apakah Anda yakin ingin menghapus data ini?</p>

              <div class="modal-actions">
                <button id="btnCancel" class="btn btn-secondary w-50">Batal</button>
                <a id="btnConfirmDelete" class="btn btn-danger w-50">Hapus</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>