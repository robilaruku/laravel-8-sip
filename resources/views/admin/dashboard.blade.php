@extends('admin.template.admin')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Sales Graph
                    </h3>
                </div>
                <div class="card-body">
                    <canvas class="chart" id="sales-chart" style="height: 250px"></canvas>
                </div>
            </div>
        </div>
         <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Latest transaction
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trx_all as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->trx_date)) }}</td>
                                    <td>{{ number_format($item->price,2,',','.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var chart = document.getElementById('sales-chart').getContext('2d');
        var areaChart = new Chart(chart, {
             type : 'line',
            data : {
                labels : {!! json_encode($chart['months']) !!},
                datasets : [
                    {
                        label : 'Overall Sales',
                        data :  {{ json_encode($chart['totals']) }},
                        backgroundColor: [
                            'rgba(153, 102, 255, 0.2)',

                        ],
                        borderColor: [
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }

                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
