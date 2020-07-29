<?php
    $tgl = date('Y-m-d');
    $prevN = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    $bulan = tglIndonesia(date('F Y', $prevN));
?>
<body id="page-top">
  <div class="container-fluid"> 
<div class="row">
            
            <div class="col-lg-5">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $title ?> Pegawai</h6>
                </div>
                <?= $this->session->flashdata('message'); ?>
                <form method="POST" action="<?php echo site_url('kepaladivisi/insert_keDB');?>">
                <div class="card-body">
                  <div class="form-group row">
                      <label for="tanggal" class="col-sm-4 col-form-label">Bulan </label>
                      <div class="col-sm-8">
                          <input type="text" readonly="" id="bulan" name="bulan" value="<?php echo $bulan ?>" class="form-control"  required>
                      </div>
                  </div>  
                  <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">Penilai </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="penilai" name="penilai" value="<?=$user['name']?>" readonly="">
                    </div>
                  </div>  
                  <div class="form-group row">
                  <label for="rekening" class="col-sm-4 col-form-label">ID Pegawai</label>
                  <div class="input-group col-sm-8">
                    <input type="text" name="idpegawai" id="idpegawai" class="form-control" readonly="" autofocus="">
                    <?=form_error('kode')?>
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                        <i class="fa fa-search"></i>
                      </button>
                    </span>
                    
                  </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">Nama </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama" name="nama" value="" readonly="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8">
                        <input type="hidden" class="form-control" id="divisi" name="divisi" value="" readonly="">
                    </div>
                </div>    
                       
                    </div>
                  </div>

                </div>
            
            <div class="col-lg-7">

              <!-- Circle Buttons -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Form Penilaian</h6>
                </div>
                <div class="card-body">
                    <?php foreach ($kategori as $nama) : ?>
                      <div class="form-group row">
                      <label for="Kategori"  class="col-sm-4 col-form-label"><?=$nama['kategori']?></label><input type="hidden" name="kategori[]" value="<?=$nama['kategori']?>">        
                      <div class="col-sm-4">                      
                        <input type="number" min="10" max="100" onchange="handleChange(this);" class="form-control" name="nilai[]"required>
                      </div>
                </div> 
                    <?php endforeach; ?>
                <hr>
                <div class="card-body">
                  <div class="form-group row">
                  <label class="col-sm-5">Kelebihan dari yang dinilai</label>
                  <div class="col-sm-6">  
                    <textarea name="kelebihan" class="form-control" required=""></textarea>
                  </div>
                   <label class="col-sm-5">Kekurangan dari yang dinilai</label>
                  <div class="col-sm-6">  
                    <textarea name="kekurangan" class="form-control" required=""></textarea>
                  </div>
                   <label class="col-sm-5">Pelatihan yang diperlukan</label>
                  <div class="col-sm-6">  
                    <textarea name="pelatihan" class="form-control" required=""></textarea>
                  </div>
                  </div>
                </div>
                <button type="submit" id="add" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Input</button>
              </div>
                </div>
                </div>
              </div>
              </form> 
            </div>

        </div>
        <!-- /.container-fluid -->
<div class="modal fade" id="modal-item" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Pilih Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center;width: 30px;">No.</th>
                      <th style="text-align: center">Id Pegawai</th>
                      <th style="text-align: center">Nama</th>
                      <th style="text-align: center;width: 200px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($karyawan as $m) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $m['kode']; ?></td>
                            <td><?= $m['nama']; ?></td>
                            <td class="text-center">
                              <button class="btn btn-xs btn-info" id="select" 
                              data-kode="<?=$m['kode'] ?>"
                              data-nama="<?=$m['nama']; ?>"
                              data-divisi="<?=$m['divisi']; ?>">
                              <i class="fa fa-check"></i> Select
                              </button>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
        </div>
    </div>
      </body>
    </div>

<script>
  $(document).on('click','#select', function()
    {
      $('#idpegawai').val($(this).data('kode'))
      $('#nama').val($(this).data('nama'))
      $('#divisi').val($(this).data('divisi'))
      $('#modal-item').modal('hide')
    }
)  
</script>
<script>
 function handleChange(input) {
    if (input.value <= 0) alert('nilai Tidak Kurang dari NOL');
    if (input.value > 100) alert('nilai melebihi 100');
  }

</script>