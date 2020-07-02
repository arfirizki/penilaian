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
              <?= $this->session->flashdata('message'); ?>
              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Karyawan</a>
              <div class="table-responsive">
                <table id="dataTable" class="table table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Id Karyawan</th>
                      <th>Nama</th>
                      <th>NIK</th>
                      <th style="text-align: center">Action</th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php $i = 1; ?>
                    <?php foreach ($pegawai as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['kode']; ?></td>
                            <td><?= $m['nama']; ?></td>
                            <td><?= $m['nik']; ?></td>
                            <td style="text-align: center">
                              <a class="badge badge-success" href="<?=site_url('kepaladivisi/overview/'.$m['kode'])?>">
                                <i class="fa fa-search"></i> Overview
                              </a> |
                              <button id="update" 
                                  data-toggle="modal" 
                                  data-target="#modal-item-update" 
                                  class="badge badge-primary"
                                  data-kode="<?=$m['kode']?>"
                                  data-nama="<?=$m['nama']?>"
                                  data-email="<?=$m['email']?>"
                                  data-nik="<?=$m['nik']?>"
                                  data-ttl="<?=$m['ttl']?>"
                                  data-divisi="<?=$m['divisi']?>"
                                  data-alamat="<?=$m['alamat']?>"
                                  data-telp="<?=$m['telp']?>"
                                  >
                              <i class="fa fa-update"></i> Update
                              </button> | 
                              <button id="del" class="badge badge-danger" data-id="<?=$m['kode']?>">
                                <i class="fa fa-trash"></i> Delete
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

        </div>
        <!-- /.container-fluid -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('kepaladivisi/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Karyawan" required="" autocomplete="off"><br>
                        <input type="number" class="form-control" id="nik" name="nik" placeholder="nik" required="" autocomplete="off"><br>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email@email.com" required="" autocomplete="off"><br>
                        <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Tegal,Surbaya ,Jakarta" required="" autocomplete="off"><br>
                        <label>Tanggal Lahir</label><input type="date" class="form-control" id="tgl" name="tgl" required="" autocomplete="off" placeholder="tgl lahir"><br>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required="" autocomplete="off"><br>
                        <input type="number" class="form-control" id="telp" name="telp" placeholder="Telpon" required="" autocomplete="off"><br>
                        <label>Tanggal Masuk</label><input type="date" class="form-control" id="masuk" name="masuk" required="" autocomplete="off"><br>
                        <input type="hidden" name="divisi" value="<?=$user['divisi']?>">
                        <div class="col-sm-8">             
                        <select id="jabatan" name="jabatan" class="form-control" required>
                        <option value="">--Pilih Jabatan--</option>
                        <?php foreach ($jabatan as $c => $value) {
                          echo '<option value="'.$value->id.'">'.$value->jabatan.'</option>';
                        } ?>
                        </option>
                      </select>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</div>
<div class="modal fade" id="modal-item-update" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control" readonly="" required name="id" id="id_edit"><br>
                <input type="text" class="form-control"  name="nama" id="nama_edit" required=""><br>
                <input type="text" class="form-control"  name="email" id="email_edit" required=""><br>
                <input type="number" class="form-control"  name="nik" id="nik_edit" required=""><br>
                <input type="number" class="form-control"  name="telp" id="telp_edit" required=""><br>
                <input type="number" class="form-control" name="divisi" id="divisi_edit" value="<?php echo $m['divisi'] ?>">
                <input type="text" class="form-control"  name="alamat" id="alamat_edit" required=""><br>
                <input type="text" class="form-control"  name="ttl" id="ttl_edit" required=""><br>
                <select name="jabatan" id="jabatan_edit" class="form-control" required>
                <option value="">--Edit Jabatan--</option>
                <?php foreach ($jabatan as $c => $value) {
                  echo '<option value="'.$value->id.'">'.$value->jabatan.'</option>';
                } ?>                
                </select><br>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="edit-proses" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update</button>
        </div>
        </div>
    </div>
<script>
$(document).on('click','#update', function()
    {
      $('#nama_edit').val($(this).data('nama'))
      $('#email_edit').val($(this).data('email'))
      $('#id_edit').val($(this).data('kode'))      
      $('#nik_edit').val($(this).data('nik'))         
      $('#telp_edit').val($(this).data('telp'))         
      $('#alamat_edit').val($(this).data('alamat'))         
      $('#ttl_edit').val($(this).data('ttl'))         
      $('#modal-item').modal('hide')
    }
) 
$(document).on('click', '#edit-proses', function()
    {
      var nama = $('#nama_edit').val()
      var email = $('#email_edit').val()
      var kode = $('#id_edit').val()
      var jabatan = $('#jabatan_edit').val()
      var divisi = $('#divisi_edit').val()
      var ttl = $('#ttl_edit').val()
      var telp = $('#telp_edit').val()
      var alamat = $('#alamat_edit').val()
      var nik = $('#nik_edit').val()
      if (nama == '') {
        alert('Isi Nama')
        $('#nama_edit').focus()
      } else if (email == '') {
        alert('Email harap disi')
         $('#email_edit').focus()
      } else if (jabatan == '') {
        alert('Jabatan harap disi')
         $('#jabatan_edit').focus()
      } else if (ttl == '') {
        alert('TTL harap disi')
         $('#ttl_edit').focus()
      } else if (telp == '') {
        alert('No Telp harap disi')
         $('#telp_edit').focus()
      } else if (alamat == '') {
        alert('Alamat harap disi')
         $('#alamat_edit').focus()
      } else if (nik == '') {
        alert('no NIK harap disi')
         $('#nik_edit').focus()
      }
      else {
        $.ajax({
        type :'POST',
        url:'<?=site_url('karyawan/edit') ?>',
        data: {'edit' : true,'nama':nama,'email': email,'kode':kode,'jabatan':jabatan,'divisi':divisi,'ttl' : ttl,'telp': telp,'alamat':alamat,'nik':nik}, 
        dataType : 'json',
        success: function(result) {
          if (result.success == true) {
            alert('Karyawan Berhasil di Update')
            $('#modal-item-update').modal('hide');
            location.reload('<?=site_url('kepaladivisi/pegawai') ?>');
          } else { 
            alert('Gagal')}
           } 
        })
      } 
    }
  )
$(document).on('click','#del', function () {
  if (confirm('Apakah Anda Yakin?')) {
    var id = $(this).data('id')
    $.ajax({
      type : "POST",
      url : '<?=site_url('karyawan/del')?>',
      dataType : 'json',
      data: {'id' : id},
      success : function(result) {
        if (result.success == true) {
          alert('Karyawan Telah Di Hapus');
          location.reload('<?=site_url('kepaladivisi/pegawai') ?>');
        }else{
         alert('Gagal Hapus'); 
        }
      }
      })

  }
})
</script>