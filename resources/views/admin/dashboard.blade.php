@extends('layouts.admin')
@section('content')
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
          <h3 class="font-weight-bold">Welcome {{ Auth::user()->name }}</h3>
          <h6 class="font-weight-normal mb-0">All systems are running smoothly! 
            {{-- You have <span class="text-primary">3 unread alerts!</span> --}}
          </h6>
        </div>
      </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
         <div class="d-flex justify-content-between">
          <p class="card-title">Peserta Event</p>
          {{-- <a href="#" class="text-info">View all</a> --}}
         </div>
          <p class="font-weight-500">
            Jumlah peserta yang telah mengikuti event di yang diselenggarakan oleh <span class="text-primary">Balai Teknologi Informasi dan Komunikasi Pendidikan</span>
          </p>
          <div id="peserta-legend" class="chartjs-legend mt-4 mb-2"></div>
          <canvas id="peserta-chart"></canvas>
        </div>
      </div>
    </div>
  </div>

@push('scripts')
<script>
  var ctx = document.getElementById('peserta-chart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode($data['event_name']) !!},
      datasets: [{
        label: 'Peserta',
        data: {!! json_encode($data['user_count']) !!},
        backgroundColor: '#98BDFF',
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });

  var ctx = document.getElementById('peserta-chart').getContext('2d');

</script>
    
@endpush
@endsection

