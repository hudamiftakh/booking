<nav class="sidebar-nav scroll-sidebar" data-simplebar>
  <ul id="sidebarnav">
    <li class="nav-small-cap">
      <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
      <span class="hide-menu">Menu Aplikasi</span>
    </li>
    <!-- <li class="sidebar-item">
      <a class="sidebar-link sidebar-link" href="<?php echo base_url('dashboard') ?>" aria-expanded="false">
        <span class="rounded-3">
          <i class="ti ti-dashboard"></i>
        </span>
        <span class="hide-menu"> Dashboard</span>
      </a>
    </li> -->
    <li class="sidebar-item">
      <a class="sidebar-link sidebar-link" href="<?php echo base_url('booking') ?>" aria-expanded="false">
        <span class="rounded-3">
          <i class="ti ti-layout-grid"></i>
        </span>
        <span class="hide-menu"> Booking</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a class="sidebar-link sidebar-link" href="<?php echo base_url('logout') ?>" aria-expanded="false">
        <span class="rounded-3">
          <i class="ti ti-logout"></i>
        </span>
        <span class="hide-menu">Logout</span>
      </a>
    </li>
  </ul>
  <div class="unlimited-access hide-menu bg-light-primary position-relative my-7 rounded">
    <div class="d-flex">
      <div class="unlimited-access-title">
        <h6 class="fw-semibold fs-4 mb-6 text-dark w-85" style="color: orange">Dashboard Dinsos
          <?= date('Y'); ?>
        </h6>
        <!-- <button class="btn btn-primary fs-2 fw-semibold lh-sm">Homepage</button> -->
      </div>
      <div class="unlimited-access-img">
        <img src="<?php echo base_url(); ?>dist/images/backgrounds/rocket.png" style="width: 100%" alt=""
          class="img-fluid">
      </div>
    </div>
  </div>
</nav>