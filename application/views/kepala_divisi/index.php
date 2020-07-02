<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1> <marquee>Selamat datang Kepala Divisi <?=$karyawan->divisi?> Di Sistem Penilaian Pegawai STT Bandung</marquee>
    <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?=$pegawai?> Pegawai divisi <?=$karyawan->divisi?></div>
              <a href="<?= base_url('kepaladivisi/pegawai'); ?>" class="h5 mb-0 font-weight-bold text-gray-800">Pegawai</a>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"></div>
              <a href="<?= base_url('kepaladivisi/penilaian'); ?>" class="h5 mb-0 font-weight-bold text-gray-800">Penilaian</a>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-user-tie fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Chart -->
<div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Overview Nilai Dari Pegawai <?=$bulan?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="container">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
  <div class="col-lg-5 col-xl-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?= $this->session->flashdata('message'); ?></h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <table class="table table-responsive table-striped">
                    <tbody>
                     <?php $i = 1; ?>
                    <?php foreach ($data as $s) : ?>
                        <tr>
                            <th scope="row">#<?= $i; ?>.</th>
                            <td><?= $s['kode']; ?></td>
                            <td><?= $s['nama']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach ?>
                  </tbody>
                  </table>
                  </div>                  
                </div>
              </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<script src="<?= base_url(''); ?>/vendor/sbadmin2/vendor/chart.js/Chart.min.js"></script>
<script type="text/javascript">
    var ctx = document.getElementById('myAreaChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [ <?php
                    foreach ($query as $row) {
                        extract($row);
                        echo "'{$nama}',";
                    } ?>
          
        ],
        datasets: [{
            label: 'Total Nilai',
            backgroundColor: '#ADD8E6',
            borderColor: '##93C3D2',
            data: [<?php
                    foreach ($query as $row) {
                        extract($row);
                        echo "'{$nilai}',";
                    } ?>
              
            ]
        }]

    },
});
 
  </script>
