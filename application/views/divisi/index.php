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
              <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Divisi</a>
              <div class="table-responsive">
                <table id="DataTable" class="table table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Divisi</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="cart_table"> 
                    <?php $this->view('divisi/cart_data') ?>
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
                <h5 class="modal-title" id="newMenuModalLabel">Add New Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('divisi/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="divisi" name="divisi" placeholder="Nama Divisi" required="" autocomplete="off"><br>
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
                <h5 class="modal-title">Edit Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <input type="hidden" id="id" name="id">
                <input type="text" class="form-control"  name="divisi_edit" id="divisi_edit" required=""><br>
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
      $('#divisi_edit').val($(this).data('divisi'))    
      $('#id').val($(this).data('id'))    
      $('#modal-item').modal('hide')
    }
) 
$(document).on('click', '#edit-proses', function()
    {
      var divisi = $('#divisi_edit').val()
      var id = $('#id').val()
      if (divisi == '') {
        alert('Divisi tdk boleh kosong')
        $('#divisi_edit').focus()
      }
      else {
        $.ajax({
        type :'POST',
        url:'<?=site_url('divisi/edit') ?>',
        data: {'edit' : true,'divisi':divisi,'id':id}, 
        dataType : 'json',
        success: function(result) {
          if (result.success == true) {
            $('#cart_table').load('<?=site_url('divisi/cart_data') ?>')
            alert('Divisi Berhasil di Update')
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
      url : '<?=site_url('divisi/del')?>',
      dataType : 'json',
      data: {'id' : id},
      success : function(result) {
        if (result.success == true) {
          $('#cart_table').load('<?=site_url('divisi/cart_data') ?>')
        }else{
         alert('Gagal Hapus'); 
        }
      }
      })

  }
})
</script>