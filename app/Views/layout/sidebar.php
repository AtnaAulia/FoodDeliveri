<?php
$uri = service('uri');

$segment  = $uri->getTotalSegments() >= 1 ? $uri->getSegment(1) : '';
$segment2 = $uri->getTotalSegments() >= 2 ? $uri->getSegment(2) : '';
$role = session()->get('role');
?>



<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="<?= base_url('/'); ?>"><h3>Food Go 🛵</h3></a>
    <a class="sidebar-brand brand-logo-mini" >🛵</a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="<?= base_url('assets/images/faces/face15.jpeg') ?>" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal"><?= session('nama') ?></h5>
            <span><?= session('role') ?></span>
          </div>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items <?= ($segment === '') ? 'active' : ''?>">
  <a class="nav-link " href="<?= base_url('/') ?>">
    <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
    <span class="menu-title">Dashboard</span>
  </a>
</li>
<?php if($role === 'admin') : ?>
<li class="nav-item menu-items <?= ($segment === 'customers') ? 'active' : '' ?>">
  <a class="nav-link " href="<?= base_url('customers') ?>">
    <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
    <span class="menu-title">Customer</span>
  </a>
</li>

<li class="nav-item menu-items <?= ($segment === 'menus') ? 'active' : '' ?>">
  <a class="nav-link " href="<?= base_url('menus') ?>">
    <span class="menu-icon"><i class="mdi mdi-book"></i></span>
    <span class="menu-title">Menus</span>
  </a>
</li>

<li class="nav-item menu-items <?= ($segment === 'drivers') ? 'active' : '' ?>">
  <a class="nav-link " href="<?= base_url('drivers') ?>">
    <span class="menu-icon"><i class="mdi mdi-car-back"></i></span>
    <span class="menu-title">Drivers</span>
  </a>
</li>

<li class="nav-item menu-items <?= ($segment === 'restaurants') ? 'active' : '' ?>">
  <a class="nav-link " href="<?= base_url('restaurants') ?>">
    <span class="menu-icon"><i class="mdi mdi-silverware-fork-knife"></i></span>
    <span class="menu-title">Restaurants</span>
  </a>
</li>
<li class="nav-item menu-items <?= ($segment === 'orders') ? 'active' : '' ?>">
  <a class="nav-link " href="<?= base_url('orders') ?>">
    <span class="menu-icon"><i class="mdi mdi-silverware-fork-knife"></i></span>
    <span class="menu-title">Orders</span>
  </a>
</li>
<?php elseif($role === 'owner') : ?>
<li class="nav-item menu-items <?= ($segment === 'laporan') ? 'active menu-open' : '' ?>">
  <a class="nav-link" data-toggle="collapse" href="#laporanMenu" aria-expanded="false" aria-controls="laporanMenu">
    <span class="menu-icon"><i class="mdi mdi-file-chart"></i></span>
    <span class="menu-title">Laporan</span>
    <i class="menu-arrow"></i>
  </a>
  <div class="collapse <?= ($segment === 'laporan') ? 'show' : '' ?>" id="laporanMenu">
    <ul class="nav flex-column sub-menu">
      <li class="nav-item <?= ($segment === 'laporan' && $segment2 === 'restoran') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('laporan/restoran') ?>">Laporan Restoran</a>
      </li>
      <li class="nav-item <?= ($segment === 'laporan' && $segment2 === 'driver') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('laporan/driver') ?>">Laporan Driver</a>
      </li>
      <li class="nav-item <?= ($segment === 'laporan' && $segment2 === 'pendapatan') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('laporan/pendapatan') ?>">Laporan Pendapatan</a>
      </li>
      <li class="nav-item <?= ($segment === 'laporan' && $segment2 === 'orders') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('laporan/orders') ?>">Laporan Order</a>
      </li>
    </ul>
  </div>
</li>
<?php endif; ?>

  </ul>

</nav>