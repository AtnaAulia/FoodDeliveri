<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">

  <!-- PAGE TITLE -->
  <div class="page-header mb-4">
    <h3 class="page-title text-white fw-bold">Dashboard</h3>
  </div>

  <!-- STAT CARDS -->
  <div class="row g-4 mb-4">
    <?php
    $cards = [
      ['title' => 'Customers',  'icon' => 'mdi-account-group',        'value' => $totalCustomers ?? 0,   'color' => 'primary'],
      ['title' => 'Menu',       'icon' => 'mdi-book',                 'value' => $totalMenus ?? 0,       'color' => 'success'],
      ['title' => 'Driver',     'icon' => 'mdi-car',                  'value' => $totalDrivers ?? 0,     'color' => 'info'],
      ['title' => 'Restaurant', 'icon' => 'mdi-silverware-fork-knife','value' => $totalRestaurants ?? 0, 'color' => 'warning'],
    ];
    ?>

    <?php foreach ($cards as $c): ?>
      <div class="col-xl-3 col-md-6">
        <div class="card border-0 h-100 dashboard-stat-card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h2 class="mb-1 text-white"><?= $c['value'] ?></h2>
              <p class="text-muted mb-0"><?= $c['title'] ?></p>
            </div>
            <div class="icon-circle bg-<?= $c['color'] ?>">
              <i class="mdi <?= $c['icon'] ?>"></i>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- REVENUE & ORDER SUMMARY -->
  <div class="row g-4">

    <!-- REVENUE CHART -->
<div class="col-lg-8">
  <div class="card border-0 h-100 dashboard-card">
    <div class="card-body">
      <h4 class="card-title text-white mb-3">Revenue</h4>
      <div style="height:300px;">
        <canvas id="revenueChart"></canvas>
      </div>
    </div>
  </div>
</div>

    <!-- ORDER SUMMARY -->
    <div class="col-lg-4">
      <div class="card border-0 h-100 dashboard-card order-summary-card">
        <div class="card-body">
          <h4 class="card-title text-white mb-3">Order Summary</h4>

          <ul class="list-group list-group-flush order-summary-list">
            <li class="list-group-item d-flex justify-content-between total">
              Total <span class="badge bg-primary"><?= $totalOrders ?? 0 ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between selesai">
              Selesai <span class="badge bg-success"><?= $totalOrdersSelesai ?? 0 ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between diproses">
              Diproses <span class="badge bg-warning"><?= $totalOrdersDiproses ?? 0 ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between dikirim">
              Dikirim <span class="badge bg-info"><?= $totalOrdersDikirim ?? 0 ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between dibatalkan">
              Dibatalkan <span class="badge bg-danger"><?= $totalOrdersDibatalkan ?? 0 ?></span>
            </li>
          </ul>

         

        </div>
      </div>
    </div>

  </div>
</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('revenueChart').getContext('2d');

// Gradient ala Corona Admin
const gradient = ctx.createLinearGradient(0, 0, 0, 300);
gradient.addColorStop(0, 'rgba(99,102,241,0.6)');
gradient.addColorStop(1, 'rgba(99,102,241,0.05)');

new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?= json_encode($chartLabel) ?>,
    datasets: [{
      label: 'Revenue',
      data: <?= json_encode($chartData) ?>,
      fill: true,
      backgroundColor: gradient,
      borderColor: '#6366f1',
      borderWidth: 3,
      tension: 0.4,
      pointRadius: 0
    }]
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    plugins: {
      legend: { display: false }
    },
    scales: {
      x: {
        grid: { display: false },
        ticks: { color: '#cbd5e1' }
      },
      y: {
        grid: { color: 'rgba(255,255,255,0.05)' },
        ticks: {
          color: '#cbd5e1',
          callback: value => 'Rp ' + value.toLocaleString('id-ID')
        }
      }
    }
  }
});
</script>



<?= $this->endSection() ?>
