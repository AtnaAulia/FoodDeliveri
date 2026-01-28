<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
  <h3 class="page-title">Dashboard</h3>
</div>

<!-- Total -->
<div class="row dashboard-cards">

  <div class="col-md-3">
    <div class="dashboard-card">
      <div class="icon bg-primary">
        <i class="mdi mdi-account-group"></i>
      </div>
      <div class="info">
        <h3><?= esc($totalCustomers ?? 0) ?></h3>
        <p>Customers</p>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="dashboard-card">
      <div class="icon bg-primary">
        <i class="mdi mdi-book"></i>
      </div>
      <div class="info">
        <h3><?= esc($totalMenus ?? 0) ?></h3>
        <p>Menu</p>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="dashboard-card">
      <div class="icon bg-primary">
        <i class="mdi mdi-car-back"></i>
      </div>
      <div class="info">
        <h3><?= esc($totalDrivers ?? 0) ?></h3>
        <p>Driver</p>
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="dashboard-card">
      <div class="icon bg-primary">
        <i class="mdi mdi-silverware-fork-knife"></i>
      </div>
      <div class="info">
        <h3><?= esc($totalRestaurants ?? 0) ?></h3>
        <p>Restaurant</p>
      </div>
    </div>
  </div>

</div>

<!-- chart -->
<div class="row mt-4">

  <!-- Revenue -->
  <div class="col-md-8">
    <div class="box-header">
      <h5>Revenue</h5>
    </div>
    <canvas id="revenueChart" height="120"></canvas>
  </div>

  <!-- order summary -->
  <div class="col-md-4">
    <div class="dashboard-box">
      <div class="box-header">
        <h5>Order Summary</h5>
    </div>
    <ul class="summary-list">
      <li class="total"><span>Total Order</span> <span class="float-right"><?= esc($totalOrders ?? 0) ?></span></li>
      <li class="success"><span>Selesai</span> <span class="float-right"><?= esc($totalOrdersSelesai ?? 0) ?></span></li>
      <li class="process"><span>Diproses</span> <span class="float-right"><?= esc($totalOrdersDiproses ?? 0) ?></span></li>
      <li class="delivery"><span>Dikirim</span> <span class="float-right"><?= esc($totalOrdersDikirim ?? 0) ?></span></li>
      <li class="cancel"><span>Dibatalkan</span> <span class="float-right"><?= esc($totalOrdersDibatalkan ?? 0) ?></span></li>
    </ul>
  </div>
</div>

<!-- Tranding menu -->
<div class="col-md-8">
  <div class="dashboard-box">
    <div class="box-header">
      <h5>Tranding Menu</h5>
    </div>
    <ul class="tranding-list">
      <li class="success"><span>Terjual</span> <span class="float-right"><?= esc($totalTerjual ?? 0) ?></span></li>
      <li class="cancel"><span>Dibatalkan</span> <span class="float-right"><?= esc($totalDibatalkan ?? 0) ?></span></li>
    </ul>
  </div>
</div>


<?= $this->endSection() ?>

