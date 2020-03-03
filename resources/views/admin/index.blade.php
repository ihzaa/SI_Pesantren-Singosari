@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Dashboard')
@section('content')
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Santri</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\santri::count()}} Orang</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-child fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengajar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\pengajar::count()}} Orang</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-male fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mata Pelajaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\mata_pelajaran::count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="row d-flex justify-content-center">
    <!-- Card Carousel -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Carousel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\carousel::count()}}</div>
                        <hr>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{\App\carousel::where('status','aktif')->count()}} Aktif</div>
                    </div>
                    <div class="col-auto mt-3">
                        <i class="far fa-images fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Informasi -->
    <div class="col-xl-4 col-md-6 mb-4 ">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Informasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\pengumuman::count()}}</div>
                        <hr>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{\App\pengumuman::where('prioritas','y')->count()}} Prioritas</div>
                    </div>
                    <div class="col-auto mt-3">
                        <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Artikel -->
    <div class="col-xl-4 col-md-6 mb-4 ">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-4">Artikel</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\artikel::count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-newspaper  fa-2x text-gray-300 mt-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<hr>

<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-10 ">
        <h2>DONASI</h2>
        {{-- <div class="card shadow mb-4"> --}}
        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tahun 2020</h6>
                <div class="row mr-2">
                    <?php
                        $dns = \App\donasi_masuk::whereYear('dibuat','2020')->pluck('nominal');
                        $total = 0;
                        for($a = 0; $a < count($dns); $a++){
                            $total += $dns[$a];
                        }
                        // $dns = array_sum($dns);
                    ?>
                    <h6 class="m-0 font-weight-bold text-primary">Total Donasi Terkumpul Tahun 2020 : Rp.
                        {{number_format($total)}}</h6>
                </div>

            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
                <hr>
                {{-- Styling for the area chart can be found in the <code>/js/demo/chart-area-demo.js</code> file. --}}
            </div>
        </div>
        {{-- </div> --}}
    </div>
</div>

@endsection

@section('js')
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
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

// Area Chart Example
var jan = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '01')->pluck('nominal'))}};
var feb = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '02')->pluck('nominal'))}};
var mar = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '03')->pluck('nominal'))}};
var apr = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '04')->pluck('nominal'))}};
var mei = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '05')->pluck('nominal'))}};
var jun = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '06')->pluck('nominal'))}};
var jul = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '07')->pluck('nominal'))}};
var aug = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '08')->pluck('nominal'))}};
var sep = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '09')->pluck('nominal'))}};
var oct = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '10')->pluck('nominal'))}};
var nov = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '11')->pluck('nominal'))}};
var des = {{str_replace('"','',\App\donasi_masuk::whereMonth('dibuat', '12')->pluck('nominal'))}};
const arrSum = arr => arr.reduce((a,b) => a + b, 0);
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Earnings",
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
      data: [arrSum(jan),arrSum(feb),arrSum(mar),arrSum(apr),arrSum(mei),arrSum(jun),arrSum(jul),arrSum(aug),arrSum(sep),arrSum(oct),arrSum(nov),arrSum(des)],
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
            return 'Rp. ' + number_format(value);
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
          return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});

</script>
@endsection
