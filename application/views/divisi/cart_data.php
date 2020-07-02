<?php $no = 1;
  if ($divisi->num_rows() > 0) {  
  foreach ($divisi->result() as $c => $data) { 
    ?>
  <tr>
    <td><?=$no++?>.</td>
    <td ><?=$data->divisi?></td>
    <td style="text-align: center">    
    <button id="update" 
        data-toggle="modal" 
        data-target="#modal-item-update" 
        class="badge badge-primary"
        data-id="<?=$data->id?>"
        data-divisi="<?=$data->divisi?>"
    >
    <i class="fa fa-update"></i> Update
    </button> | 
    <button id="del" class="badge badge-danger" data-id="<?=$data->id?>">
      <i class="fa fa-trash"></i> Delete
    </button>                       
    </td>
  </tr>
  <tr>
  <?php  }
  }else {
  echo '<tr>
  <td colspan="6" class="text-center">Tidak ada item </td>
  </tr>';
  }
?>