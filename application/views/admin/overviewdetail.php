<body id="page-top">
<div class="container-fluid"> 
<div class="row">
            
            <div class="col-lg-12">

              <!-- Circle Buttons -->
              <div>
                <div class="card-header py-8 no-print">
                    <a href="<?=site_url('karyawan')?>" class="btn btn-waring btn-flat">
                      <i class="fa fa-undo"></i> Back
                    </a> 
                    <form action="<?=base_url('admin/overviewdetail')?>" method="POST">
                          <select id="kategori" name="kategori" class="form-control" required>
                            <option value="">--Pilih Kategori --</option>
                            <?php foreach ($getkategori as $value) {
                              echo '<option value="'.$value->kategori.'">'.$value->kategori.'</option>';
                            } ?>
                            </option>
                          </select>
                          <input type="hidden" name="kode" value="<?=$pegawai->kode?>">
                    <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Refresh</button>
                    </form>
                </div>
                <br>
                <br>
                <h2>OverView Penilaian Kinerja Pegawai <?=$pegawai->nama?> Perbulan Berdasarkan <?=$kategori?></h2>
                <!-- <div id="graph"></div> -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>  
            </div>  
</div>
</div>
<script src="<?= base_url(''); ?>/vendor/sbadmin2/vendor/chart.js/Chart.min.js"></script>
<script>
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
     labels: [ <?php
                    foreach ($query as $row) {
                        extract($row);
                        echo "'{$bulan}',";
                    } ?>],
    datasets: [{
      label: "Nilai",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [ <?php
                    foreach ($query as $row) {
                        extract($row);
                        echo "'{$nilai}',";
                    } ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
    </script>

      </body>
</div>
