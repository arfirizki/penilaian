<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

  <!-- Content Row -->
  <div class="row"> 

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Admin</div>
              <a href="<?= base_url('admin/data'); ?>" class="h5 mb-0 font-weight-bold text-gray-800">Data</a>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Karyawan</div>
              <a href="<?= base_url('karyawan'); ?>" class="h5 mb-0 font-weight-bold text-gray-800">Karyawan</a>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-bookmark fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <a href="<?= base_url('user/informasi'); ?>" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Information</a>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-folder fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menu</div>
              <a href="<?= base_url('menu/submenu'); ?>" class="h5 mb-0 font-weight-bold text-gray-800">Submenu Management</a>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-folder-open fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->