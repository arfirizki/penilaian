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
              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Kategori</a>
              <div class="table-responsive">
                <table id="dataTable" class="table table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Kategori</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php $i = 1; ?>
                    <?php foreach ($kategori as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['kategori']; ?></td>
                            <td style="text-align: center">
                              <button id="update" 
                                  data-toggle="modal" 
                                  data-target="#modal-item-update" 
                                  class="badge badge-primary"
                                  data-id="<?=$m['id']?>"
                                  data-nama="<?=$m['kategori']?>"
                                  >
                              <i class="fa fa-update"></i> Update
                              </button> | 
                              <button id="del" class="badge badge-danger" data-id="<?=$m['id']?>">
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
                <h5 class="modal-title" id="newMenuModalLabel">Add New Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('penilaian/kategoriadd'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Kategori Penilaian" required="" autocomplete="off"><br>
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
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control"  name="nama" id="nama_edit" required=""><br>
                <input type="hidden" class="form-control"  name="id" id="id_edit" required=""><br>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="edit-proses" class="btn btn-primary"><i class="fa fa-paper-plane"></i>Update</button>
        </div>
        </div>
    </div>
  </div>
<script>
$(document).on('click','#update', function()
    {
      $('#nama_edit').val($(this).data('nama'))     
      $('#id_edit').val($(this).data('id'))     
      $('#modal-item').modal('hide')
    }
) 
$(document).on('click', '#edit-proses', function()
    {
      var nama = $('#nama_edit').val()
      var id = $('#id_edit').val()
      if (nama == '') {
        alert('Isi Nama')
        $('#nama_edit').focus()
      } 
      else {
        $.ajax({
        type :'POST',
        url:'<?=site_url('penilaian/kategoriedit') ?>',
        data: {'edit' : true,'nama':nama,'id':id}, 
        dataType : 'json',
        success: function(result) {
          if (result.success == true) {
            alert('Kategori Berhasil di Update')
            $('#modal-item-update').modal('hide');
            location.reload('<?=site_url('penilaian/kategori') ?>');
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
      url : '<?=site_url('penilaian/kategoridel')?>',
      dataType : 'json',
      data: {'id' : id},
      success : function(result) {
        if (result.success == true) {
          alert('Kategori Penilaian Telah Di Hapus');
          location.reload('<?=site_url('penilaian/kategori') ?>');
        }else{
         alert('Gagal Hapus'); 
        }
      }
      })

  }
})
</script>