<x-admin icon="fa-chart-line" title="Web Analytics" action="/web-analytics">
    <div class="row">
        <x-widget color="success" name="Ventas Web" icon="fa-shopping-basket">
            {{number_format(\App\Helpers\AppHelper::getSales(date('2022-02-07'))[1],2,',','.')}} € ({{\App\Helpers\AppHelper::getSales(date('2022-02-07'))[0]}})
        </x-widget>
        <x-widget color="success" name="Visitas Web" icon="fa-shopping-basket">
            {{\App\Helpers\AppHelper::getVisits()[0]}} ({{\App\Helpers\AppHelper::getVisits()[1]}})
        </x-widget>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase">Visitas Web</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">NÚMERO VISITAS</div>
                            <div class="dropdown-item" role="button" onclick="$('.visitsChart').hide();$('.perHourChart').show();">Por Hora</div>
                            <div class="dropdown-item" role="button" onclick="$('.visitsChart').hide();$('.perWeekDayChart').show();">Por Semana</div>
                            <div class="dropdown-item" role="button" onclick="$('.visitsChart').hide();$('.perMonthChart').show();">Por Mes</div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas class="visitsChart perMonthChart" id="myAreaChart"></canvas>
                        <canvas class="visitsChart perWeekDayChart" id="perWeekDayAreaChart" style="display:none"></canvas>
                        <canvas class="visitsChart perHourChart" id="perHourAreaChart" style="display:none"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header  d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-line"></i> Páginas Visitadas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive small">
                <table class="table table-bordered table-hover table-sm table-striped" id="webPagesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Veces</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $web_pages as $page => $times )
                        <tr>
                            <td>{{$times}}</td>
                            <td>{{$page}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header  d-flex align-items-center justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-chart-line"></i> Web Analytics</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive small">
                <table class="table table-bordered table-hover table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fecha / Hora</th>
                            <th>Dirección IP</th>
                            <th>Sesión</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $traffic as $item )
                        <tr>
                            <td>{{$item->date}}>{{$item->time}}</td>
                            <td>{{$item->ip}}</td>
                            <td>{{$item->session}}</td>
                            <td>{{$item->url}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@push('scripts')
<script src="js/chart.min.js"></script>
<script>
$(document).ready(function() {
    $('#webPagesTable').DataTable({
        "order": [[ 0, "desc" ]]
    });
    $('#dataTable').DataTable({
        "order": [[ 0, "desc" ]]
    });
});
Chart.defaults.global.defaultFontFamily = 'Segoe UI', '-apple-system,system-ui,BlinkMacSystemFont,Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Ene-2022","Feb-2022","Mar-2022","Abr-2022","May-2022","Jun-2022","Jul-2022","Ago-2022","Sep-2022","Oct-2022","Nov-2022","Dic-2022"],
    datasets: [{
      label: "Visitas",
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
      data: [{{\App\Helpers\AppHelper::getVisits()[0]}}],
    },{
      label: "Nuevos",
      lineTension: 0.3,
      backgroundColor: "rgba(178, 0, 0, 0.05)",
      borderColor: "rgba(178, 0, 0, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(8, 115, 223, 1)",
      pointBorderColor: "rgba(8, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(8, 115, 223, 1)",
      pointHoverBorderColor: "rgba(8, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [{{\App\Helpers\AppHelper::getVisits()[1]}}],

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
            return value;
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
          return datasetLabel + ': ' + tooltipItem.yLabel;
        }
      }
    }
  }
});
var perHourChart = new Chart(document.getElementById("perHourAreaChart"), {
  type: 'line',
  data: {
    labels: ["00h","01h","02h","03h","04h","05h","06h","07h","08h","09h","10h","11h","12h","13h","14h","15h","16h","17h","18h","19h","20h","21h","22h","23h"],
    datasets: [{
      label: "Visitas",
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
      data: [{{\App\Helpers\AppHelper::getVisitsPerHour()[1]}}],
    },{
      label: "Nuevos",
      lineTension: 0.3,
      backgroundColor: "rgba(178, 0, 0, 0.05)",
      borderColor: "rgba(178, 0, 0, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(178, 0, 0, 1)",
      pointBorderColor: "rgba(178, 0, 0, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(178, 0, 0, 1)",
      pointHoverBorderColor: "rgba(178, 0, 0, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [{{\App\Helpers\AppHelper::getVisitsPerHour()[0]}}],
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
            return value;
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
          return datasetLabel + ': ' + tooltipItem.yLabel;
        }
      }
    }
  }
});
var perWeekDayChart = new Chart(document.getElementById("perWeekDayAreaChart"), {
  type: 'line',
  data: {
    labels: ["Lun","Mar","Mie","Jue","Vie","Sab","Dom"],
    datasets: [{
      label: "Visitas",
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
      data: [{{\App\Helpers\AppHelper::getVisitsPerWeekDay()[1]}}],
    },{
      label: "Nuevos",
      lineTension: 0.3,
      backgroundColor: "rgba(178, 0, 0, 0.05)",
      borderColor: "rgba(178, 0, 0, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(178, 0, 0, 1)",
      pointBorderColor: "rgba(178, 0, 0, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(178, 0, 0, 1)",
      pointHoverBorderColor: "rgba(178, 0, 0, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [{{\App\Helpers\AppHelper::getVisitsPerWeekDay()[0]}}],
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
            return value;
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
          return datasetLabel + ': ' + tooltipItem.yLabel;
        }
      }
    }
  }
});
</script>
@endpush
</x-admin>