@extends('layouts.admin')
@section('content')
   <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between">
           <h4 class="card-title">Survey</h4>
        </div>
        <p class="card-description">
            {{ (@$survey) ? 'Survey '.$survey->name : '' }}<br>
            {{ (@$event) ? 'Kegiatan '.$event->name : '' }} 
        </p>
      </div>
   </div>


   <div class="card mt-2">
        <div class="card-body">
            <div class="alert alert-light">
                <p class="mb-0 text-dark">
                    {{ $field->question }}
                </p>
            </div>

            @if (@$most_common_answer)    
            <div class="alert alert-warning">
                <p>
                    <strong>Jawaban yang paling banyak :</strong>
                </p>
                <p>
                    {{ $most_common_answer->answer }}
                    <br>
                    <span class="text-sm">sebanyak {{ $most_common_answer->total }} orang responden</span>
                </p>
            </div>
            @endif
            {{-- foreach --}}
            @if ($field->type == 'text' || $field->type == 'textarea')
            
            <div class="row">
                <div class="col-md-3">
                    @foreach ($answers as $answer)
                    <p class="card-description">
                        {{ $loop->iteration }}. {{ $answer->answer }}
                    </p>
                    @if ($loop->iteration % 5 == 0)
                        </div><div class="col-md-6">
                    @endif
                    @endforeach
                </div>
            </div>
                
            @elseif($field->type == 'select')
            {{-- create diagram --}}
            <div class="row justify-content-center">
              <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                      <div class="d-flex justify-content-between">
                          {{-- <p class="card-title">Sales Report</p> --}}
                          {{-- <a href="#" class="text-info">View all</a> --}}
                      </div>
                          <p class="font-weight-500">Hasil Perhitungan dari total {{ $answers->count() }} Responden</p>
                          <div id="answer-legend" class="chartjs-legend mt-4 mb-2"></div>
                          <canvas id="answer-chart"></canvas>
                      </div>
                  </div>
              </div>
            </div>

            @elseif($field->type == 'number')
            <div class="row justify-content-center">
              <div class="col-md-6 mt-3">
                <canvas id="rate-chart"></canvas>
                <div id="rate-legend"></div>
              </div>
            </div>
            @endif
        </div>
   </div>
   @if (@$select_answers) 
   @push('scripts')    
   <script>
       var answerChartCanvas = $("#answer-chart").get(0).getContext("2d");
       var answerChart = new Chart(answerChartCanvas, {
         type: 'bar',
         data: {
           labels:  {!! json_encode($field->getOptions) !!},
           datasets: [{
               label: 'Jawaban',
               data: {!! json_encode($select_answers) !!},
               backgroundColor: '#98BDFF'
             },
           ]
         },
         options: {
           cornerRadius: 5,
           responsive: true,
           maintainAspectRatio: true,
           layout: {
             padding: {
               left: 0,
               right: 0,
               top: 0,
               bottom: 0
             }
           },
           scales: {
             yAxes: [{
               display: true,
               gridLines: {
                 display: true,
                 drawBorder: false,
                 color: "#F2F2F2"
               },
               ticks: {
                 display: true,
                 min: 0,
                 max: 10,
                 callback: function(value, index, values) {
                   return  value ;
                 },
                 autoSkip: true,
                 maxTicksLimit: 10,
                 fontColor:"#6C7383"
               }
             }],
             xAxes: [{
               stacked: false,
               ticks: {
                 beginAtZero: true,
                 fontColor: "#6C7383"
               },
               gridLines: {
                 color: "rgba(0, 0, 0, 0)",
                 display: false
               },
               barPercentage: 1
             }]
           },
           legend: {
             display: false
           },
           elements: {
             point: {
               radius: 0
             }
           }
         },
       });
       document.getElementById('answer-legend').innerHTML = SalesChart.generateLegend();
   </script>
   @endpush
   @endif

   {{-- rate 2 digit --}}
  

   @if (@$rate_answers)
   @php
      $rate_answers = round($rate_answers, 2);
    @endphp
    @push('scripts')
    <script>
      if ($("#rate-chart").length) {
      var areaData = {
        labels: ['Nilai'],
        datasets: [{
            data: [{{ $rate_answers }}, {{ 10 - $rate_answers }}],
            backgroundColor: [
               "#4B49AC","#FFFFFF",
            ],
            borderColor: "rgba(0,0,0,0)"
          }
        ]
      };
      var areaOptions = {
        responsive: true,
        maintainAspectRatio: true,
        segmentShowStroke: false,
        cutoutPercentage: 78,
        elements: {
          arc: {
              borderWidth: 4
          }
        },      
        legend: {
          display: false
        },
        tooltips: {
          enabled: true
        },
        legendCallback: function(chart) { 
          var text = [];
          // text.push('<div class="report-chart">');
          //   text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[0] + '"></div><p class="mb-0">Offline sales</p></div>');
          //   text.push('<p class="mb-0">88333</p>');
          //   text.push('</div>');
          //   text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[1] + '"></div><p class="mb-0">Online sales</p></div>');
          //   text.push('<p class="mb-0">66093</p>');
          //   text.push('</div>');
          //   text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[2] + '"></div><p class="mb-0">Returns</p></div>');
          //   text.push('<p class="mb-0">39836</p>');
          //   text.push('</div>');
          // text.push('</div>');
          return text.join("");
        },
      }
      var rateChartPlugins = {
        beforeDraw: function(chart) {
          var width = chart.chart.width,
              height = chart.chart.height,
              ctx = chart.chart.ctx;
      
          ctx.restore();
          var fontSize = 3.125;
          ctx.font = "500 " + fontSize + "em sans-serif";
          ctx.textBaseline = "middle";
          ctx.fillStyle = "#13381B";
      
          var text = "{{ $rate_answers }}",
              textX = Math.round((width - ctx.measureText(text).width) / 2),
              textY = height / 2;
      
          ctx.fillText(text, textX, textY);
          ctx.save();
        }
      }
      var rateChartCanvas = $("#rate-chart").get(0).getContext("2d");
      var rateChart = new Chart(rateChartCanvas, {
        type: 'doughnut',
        data: areaData,
        options: areaOptions,
        plugins: rateChartPlugins
      });
      document.getElementById('rate-legend').innerHTML = rateChart.generateLegend();
    }
    </script>
        
    @endpush
   @endif

@endsection