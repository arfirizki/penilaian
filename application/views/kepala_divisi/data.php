<?php
    $tgl = date('Y-m-d');
    $prevN = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    $bulan = tglIndonesia(date('F Y', $prevN));
?>
<body id="page-top">

  <!-- Page Wrapper -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?=$title ?></h6>
            </div>
            <div class="card-body">
              <!-- ISI -->
              <div class="table-responsive">
                  <div>
                     <?php $nn = 1; foreach($divisi as $keyd) { ?>  
                     <div class="card mb-4 py-3 border-bottom-primary"> 
                      <div class="card-body">
                        <h6 class="down"><b><?php echo $keyd->divisi;?></b></h6> 
                       <div class="form-group row">
                        <label for="Pilih Bulan" class="col-sm-1 col-form-label">Bulan</label>
                        <div class="col-sm-4">
                          <form action="<?=base_url('kepaladivisi/data')?>" method="POST">
                          <select id="bulan" name="bulan" class="form-control" required>
                            <option value="">--Pilih Bulan --</option>
                            <?php foreach ($getbulan as $value) {
                              echo '<option value="'.$value->bulan.'">'.$value->bulan.'</option>';
                            } ?>
                            </option>
                          </select>
                        </div>                       
                        <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Refresh</button>
                        </form>
                      </div>
                      </div>
                    </div>
                     <div>
                           <div class="panel-body table-responsive">
                            <table class="table table table-hover m-0">
                                 <thead>
                                    <tr>
                                       <th></th>
                                       <th>Karyawan</th>
                                       <th>Nilai</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody> 
                                  
                                    <?php $no = 1; foreach ($nilai as $key) { ?>
                                    <tr>                                       
                                       <th>
                                          <a class="btn btn-primary btn-circle" style="cursor: pointer;" onclick="rincian(<?php echo $key->kode;?>);"><span  class="text-white-50"><?php echo substr($key->nama,0,1);?></span></a>
                                       </th>
                                       <td>
                                          <h5 class="m-0"><a style="cursor: pointer;" onclick="rincian(<?php echo $key->kode;?>);"><?php echo $key->nama;?></a></h5>
                                       </td>
                                       <td>
                                          <?php echo $key->nilai?>
                                       </td>
                                       <td>
                                         <a href="<?=site_url("kepaladivisi/detail?bulan=$key->bulan&kode=$key->kode") ?>"class="btn btn-light btn-icon-split">
                                          <span class="icon text-gray-600">
                                            <i class="fas fa-arrow-right"></i>
                                          </span>
                                          <span class="text">Detail</span>
                                        </a>
                                       </td>
                                       <td>
                                       </td>
                                    </tr>
                                    <?php $no++; } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <?php $nn++; } ?>  
                  </div>
               </div>
               <!-- table-responsive -->
            </div>
            <!-- end card -->
         </div>
         <!-- end row -->

</body>
</div>