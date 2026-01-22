<?= $this->extend('layout/main'); ?>
<?= $this->section('content'); ?>

<h4 class="mb-0">Laporan Orderan</h4>
<p class="text-muted">Rekap berdasarkan Periode bulan</p>

<div class="card mb-3">
    <div class="card-body">
        <form action="<?= base_url('laporan/restoran') ?>" class="g-3" method="get">
            <div class="col-md-3">
                <label class="form-label">Bulan</label>
                <input type="date" class="form-control" name="periode" required>
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
                <th>Nama Restaurant</th>
                <th>Jumlah Menu</th>
                <th>Total Order</th>
                <th>Menu Terlaris</th>
                <th>Pendapatan</th>
              </tr>
            </thead>

            <tbody>
                <?php if(empty($laporan)): ?>
                <tr>
                  <td colspan="5" class="text-center text-muted">Belum Ada Data Menu.</td>
                </tr>
              <?php endif; ?>
              <?php $no = 1; ?>
              <?php foreach($laporan as $row): ?>
                <tr>
                  <td><?= $no++;?></td>
                 <td><?= esc($row['restaurants_name']) ?></td> 
                  <td><?= esc($row['jumlah_menu']); ?></td>
                  <td><?= esc($row['jumlah_order']); ?></td>
                  <td><?= $row['menu_terlaris'] ? $row['menu_terlaris']->nama_menu : '-' ?></td>
                  <td><?= esc($row['total_pendapatan']); ?></td>
                  
                  

                  </tr>

              <?php endforeach; ?>

              

            </tbody>
          </table>


<?= $this->endSection(); ?>