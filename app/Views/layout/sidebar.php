<?php $segment =(string) service('uri')->getSegment(1); ?>

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
            <h5 class="mb-0 font-weight-normal">Kayla Hayya</h5>
            <span>Admin</span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>z
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-calendar-today text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
            </div>
          </a>
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
  </ul>

</nav>