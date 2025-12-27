<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= esc($title ?? 'Dashboard') ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?= base_url('assets/css/toast.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/jvectormap/jquery-jvectormap.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/owl-carousel-2/owl.carousel.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/vendors/owl-carousel-2/owl.theme.default.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" />
</head>

<body>
<div class="container-scroller">
  
  <!-- TOAST -->
   <?= view('components/toast') ?>

  <!-- SIDEBAR KIRI -->
  <?= $this->include('layout/sidebar'); ?>
  
  <!-- AREA KANAN -->
  <div class="container-fluid page-body-wrapper">
    
    <!-- TOPBAR -->
    <?= $this->include('layout/navbar'); ?>
    
    <!-- KONTEN -->
    <div class="main-panel">
      <div class="content-wrapper">
        <?= $this->renderSection('content'); ?>
      </div>
     

      <!-- FOOTER KANAN -->
      <?= $this->include('layout/footer'); ?>
    </div>

  </div>
</div>

<script src="<?= base_url('assets/js/toast.js') ?>"></script>
<script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
<script src="<?= base_url('assets/vendors/chart.js/Chart.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/progressbar.js/progressbar.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/jvectormap/jquery-jvectormap.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
<script src="<?= base_url('assets/vendors/owl-carousel-2/owl.carousel.min.js') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
<script src="<?= base_url('assets/js/file-upload.js'); ?>"></script>
<script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
<script src="<?= base_url('assets/js/misc.js') ?>"></script>
<script src="<?= base_url('assets/js/settings.js') ?>"></script>
<script src="<?= base_url('assets/js/todolist.js') ?>"></script>
<script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const path = window.location.pathname;

  document.querySelectorAll('.nav-link').forEach(el => {
    el.classList.remove('active');
  });

  if (path.includes('/drivers')) {
    document.querySelector('a[href$="/drivers"]')?.classList.add('active');
  }
  else if (path.includes('/customers')) {
    document.querySelector('a[href$="/customers"]')?.classList.add('active');
  }
  else if (path.includes('/menus')) {
    document.querySelector('a[href$="/menus"]')?.classList.add('active');
  }
  else if (path.includes('/restaurants')) {
    document.querySelector('a[href$="/restaurants"]')?.classList.add('active');
  }
});
</script>


</body>
</html>
