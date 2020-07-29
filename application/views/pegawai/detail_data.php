<style type="text/css">
    body{
      font-family: Arial;
    }
    @media print {
      .no-print{
        display: none;
      }
    }
    table {
      border-collapse: collapse;
    }
  </style>
<body id="page-top">
  <div class="container-fluid"> 
<div class="row">
            
            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div>
                <div class="card-header py-8 no-print">
                    <a href="<?=site_url('pegawai/nilai')?>" class="btn btn-waring btn-flat">
                      <i class="fa fa-undo"></i> Back
                    </a> 
                    <a href="" onclick="window.print();" class="btn btn-waring btn-flat">
                      <i class="fa fa-print"></i> Print
                    </a>  
                </div>
                <br>
                <br>
                <table border="1" width="100%" align="center">
                  <thead>
                  <tr>
                      <td rowspan="6" align="center"><img style="width: 150px; height: 150px" src="<?=base_url("assets/img/logo.jpg")?>"></td>
                      <td rowspan="3" align="center" style="color: black; font-style: bold">
                        <span style="font-family: calibri; font-size: 20px">
                          SEKOLAH TINGGI TEKNOLOGI BANDUNG <br>
                            <font style="font-size: 20px;font-family: georgia;"><b>STT BANDUNG</b></font><br>
                            <font style="font-size: 12px;font-family: arial;">Jl. Soekarno Hatta 378</font><br>
                            <font style="font-size: 12px;font-family: arial;">Telp.022 522 4000  Fax.022 5209272</font>
                        </span>
                      </td>
                      <td rowspan="3">No. Dokumen :</td>
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                      <td rowspan="3" align="center" style="font-size: 25px;font-family: ebrima;color: black;" ><b>PENILAIAN KARYAWAN</b></td>
                      <td> No. Revisi &nbsp&nbsp&nbsp: </td>
                  </tr>
                  <tr>
                      <td> Tgl Berlaku&nbsp&nbsp:</td>
                  </tr>
                  <tr>
                      <td> Halaman &nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp&nbsp Dari</td>
                  </tr>
                  </thead> 
                </table>
                <br>
                <form autocomplete="off">
                <div class="card-body">
                  <div class="form-group row">
                      <label class="col-sm-3">Penilai/atasan</label>
                      <div class="col-sm-4">                      
                          <span >: <?=$data->penilai; ?></span>
                      </div>
                  </div> 
                  <div class="form-group row">
                      <label class="col-sm-3">Departemen/bagian</label>
                      <div class="col-sm-4">                      
                          <span >: <?=$data->divisi; ?></span>
                      </div>
                  </div> 
                  <div class="form-group row">
                      <label class="col-sm-3 ">Karyawan yang dinilai</label>
                      <div class="col-sm-4">                      
                          <span >: <?=$data->nama; ?></span>
                      </div>
                  </div> 
                  <div class="form-group row">
                      <label class="col-sm-3">NIK</label>
                      <div class="col-sm-4">                      
                          <span>: <?=$data->kode; ?></span>
                      </div>
                  </div> 
                </div>  
                </form>
                <table width="100%" border="1" align="center">
                <thead>
                <tr>
                  <th rowspan="2" width="10px"><center>No.</center></th>
                  <th rowspan="2"><center>KRITERIA YANG DINILAI</center></th>
                  <th colspan="2"><center>NILAI</center></th>
                </tr>
                <tr>
                  <th><center>Angka</center></th>
                  <th><center>Huruf</center></th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($nilai as $m) : ?>
                        <tr>
                            <th scope="row" style="text-align: center;"><?= $i; ?></th>
                            <td> &nbsp<?= $m['kategori']; ?></td>
                            <td style="text-align: center;"><?= $m['nilai']; ?></td>
                            <td style="text-align: center;"> 
                             <?php 
                              if(($m['nilai'] >= 91) AND ($m['nilai'] <= 100 ))
                                {
                                 echo "Amat Baik";
                                }
                                elseif(($m['nilai'] >= 76) AND ($m['nilai'] <= 90))
                                {
                                  echo "Baik";
                                }
                                elseif(($m['nilai'] >= 61) AND ($m['nilai'] <= 75))
                                {
                                  echo "Cukup";
                                }
                                elseif(($m['nilai'] >=51) AND ($m['nilai'] <= 60))
                                {
                                  echo "Sedang";
                                }
                                else
                                {
                                  echo"Kurang";
                                }
                             ?>     
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
                </table>
                <div class="card-body">
                  <div class="form-group row">
                      <label class="col-sm-2">Kriteria Penilaian : </label>
                      <div class="col-sm-2">   
                      91 - 100 : Amat Baik                   
                      </div>
                  </div> 
                  <div class="form-group row">
                      <label class="col-sm-2"></label>
                      <div class="col-sm-4">   
                      76 - 90 &nbsp&nbsp: Baik                   
                      </div>
                  </div> 
                  <div class="form-group row">
                      <label class="col-sm-2"></label>
                      <div class="col-sm-4">   
                      61 - 75 &nbsp&nbsp: Cukup                   
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2"></label>
                      <div class="col-sm-4">   
                      51 - 60 &nbsp&nbsp: Sedang                   
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-sm-2"></label>
                      <div class="col-sm-4">   
                      < 50 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: Kurang                   
                      </div>
                  </div>
                </div> 
                <div class="card-body">
                    <div class="form-group row">
                    <label class="col-sm-12">Tanggapan secara umum pejabat penilai :</label>
                    <label class="col-sm-12">a. Kelebihan dari yang dinilai : <?=$tanggapan->kelebihan ?></label>
                    <label class="col-sm-12">b. Kekurangan dari yang dinilai : <?=$tanggapan->kekurangan ?></label>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-12">Pelatihan yang diperlukan untuk yang dinilai : <?=$tanggapan->pelatihan ?></label>
                      
                    </div>
                </div> 
                <table width="100%">
                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <p>
                      <br/>
                      Yang dinilai
                      <br/>
                      <br/>
                      <br/>
                      <p>___________________</p>  
                    </td>
                    <td width="200px">
                      <p>Bandung, <?php echo date('d-m-Y'); ?>
                      <br/>
                      Penilai
                      <br/>
                      <br/>
                      <br/>
                      <p>___________________</p>  
                    </td>
                  </tr>   
                </table>
              </div>
            </div>  
          </div>  
        </div>
      </body>
    </div>