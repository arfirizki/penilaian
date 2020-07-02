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
                  <div class="panel-group m-b-0" id="accordion" role="tablist" aria-multiselectable="true">
                     <?php $nn = 1; foreach($divisi as $keyd) { ?>  
                     <a class="collapsed" role="button" data-toggle="collapse"
                                 data-parent="#accordion" href="#collapse<?php echo $nn;?>"
                                 aria-expanded="false" aria-controls="collapse<?php echo $nn;?>">
                     <div class="card mb-4 py-3 border-bottom-primary"> 
                      <div class="card-body">
                        <h6 class="down"><b><?php echo $keyd->divisi;?></b></h6>
                      </div>
                    </div>
                    </a>
                     <div id="collapse<?php echo $nn;?>" class="panel-collapse collapse"
                           role="tabpanel" aria-labelledby="heading<?php echo $nn;?>">
                           <div class="panel-body table-responsive">
                            <table class="table table table-hover m-0">
                                 <thead>
                                    <tr>
                                       <th></th>
                                       <th>Karyawan</th>
                                       <th>Bulan Ini</th>
                                       <th>Triwulan</th>
                                       <th>Semester</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php $no = 1; foreach ($karyawan as $key) { 
                                       if($keyd->divisi == $key->divisi) { ?>
                                    <tr>                                       
                                       <th>
                                          <a style="cursor: pointer;" onclick="rincian(<?php echo $key->kode;?>);"><span class="avatar-sm-box bg-primary"><?php echo substr($key->nama,0,1);?></span></a>
                                       </th>
                                       <td>
                                          <h5 class="m-0"><a style="cursor: pointer;" onclick="rincian(<?php echo $key->kode;?>);"><?php echo $key->nama;?></a></h5>
                                          <p class="m-0 text-muted font-13"><small><?php echo $key->divisi;?></small></p>
                                       </td>
                                       <td>
                                       </td>
                                       <td>
                                       </td>
                                       <td>
                                       </td>
                                    </tr>
                                    <?php $no++; } } ?>
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

            </div>   
          </div>

        </div>
</body>
</div>