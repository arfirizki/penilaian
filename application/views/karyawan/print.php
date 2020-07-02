<body onload="window.print()">
<div style="text-align: center;"><b>DATA KARYAWAN STT BANDUNG</b></div>
<br>
<br>
              <div align="center">
                <table width="500" border="1" align="center" class="table table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width: 30px;">No.</th>
                      <th style="width: 100px;">ID Karyawan</th>
                      <th style="width: 100px;">Nama</th>
                      <th style="width: 50px;">Jabatan</th>
                      <th style="width: 50px;">Divisi</th>
                    </tr>
                  </thead> 
                  <tbody> 
                    <?php $i = 1; ?>
                    <?php foreach ($karyawan as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td> &nbsp<?= $m['kode']; ?></td>
                            <td> &nbsp<?= $m['nama']; ?></td>
                            <td> &nbsp<?= $m['jabatan']; ?></td>
                            <td> &nbsp<?= $m['divisi']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
  </div>
</div>