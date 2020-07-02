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
              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Admin</a>
              <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Id Admin</th>
                      <th>Nama</th>
                      <th>email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="cart_table"> 
                    <?php $this->view('admin/cart_data') ?>
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
                <h5 class="modal-title" id="newMenuModalLabel">Add New Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?=$id?>" id="id" name="id" readonly=""><br>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Admin" required="" autocomplete="off"><br>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" required="" autocomplete="off"><br>
                        <input type="text" class="form-control" id="password" name="password" placeholder="password" required="" autocomplete="off"><br>
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
                <h5 class="modal-title">Edit Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control" readonly="" required name="id" id="id_edit"><br>
                <input type="text" class="form-control"  name="nama" id="nama_edit" required=""><br>
                <input type="text" class="form-control"  name="email" id="email_edit" required="">
                <br>
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
      $('#email_edit').val($(this).data('email'))
      $('#id_edit').val($(this).data('kode'))      
      $('#modal-item').modal('hide')
    }
) 
$(document).on('click', '#edit-proses', function()
    {
      var nama = $('#nama_edit').val()
      var email = $('#email_edit').val()
      var kode = $('#id_edit').val()
      if (nama == '') {
        alert('Isi Nama')
        $('#nama_edit').focus()
      } else if (email == '') {
        alert('Email harap disi')
         $('#email_edit').focus()
      }
      else {
        $.ajax({
        type :'POST',
        url:'<?=site_url('admin/edit') ?>',
        data: {'edit' : true,'nama':nama,'email': email,'kode':kode}, 
        dataType : 'json',
        success: function(result) {
          if (result.success == true) {
            $('#cart_table').load('<?=site_url('admin/cart_data') ?>')
            alert('Admin Berhasil di Update')
            $('#modal-item-update').modal('hide');
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
      url : '<?=site_url('admin/del')?>',
      dataType : 'json',
      data: {'id' : id},
      success : function(result) {
        if (result.success == true) {
          alert('Admin Berhasil di Update');
          location.reload('<?=site_url('admin') ?>');
        }else{
         alert('Gagal Hapus'); 
        }
      }
      })

  }
})
</script>