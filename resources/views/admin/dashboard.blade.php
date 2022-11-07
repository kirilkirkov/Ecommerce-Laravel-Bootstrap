@extends('layouts.app_admin')

@section('content')
<script src="{{ asset('js/Highcharts-5.0.14/code/highcharts.js') }}"></script>
<script src="{{ asset('js/Highcharts-5.0.14/code/modules/exporting.js') }}"></script>
<div id="container-by-month" style="min-width: 310px; height: 400px; margin: 0 auto;"></div>
<script>
    $(function() {
        Highcharts.chart('container-by-month', {
            title: {
                text: 'Monthly Orders',
                x: -20
            },
            subtitle: {
                text: 'Source: Orders table',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ]
            },
            yAxis: {
                title: {
                    text: 'Orders'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ' Orders'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [
                @php
                foreach($ordersByMonth['years'] as $year) {
                    @endphp {
                        name: '{{$year}}',
                        data: [@php echo implode(',', $ordersByMonth['orders'][$year]);@endphp]
                    },
                    @php
                }
                @endphp
            ]
        });
    });
</script>
@endsection