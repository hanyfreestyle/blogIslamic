<x-admin.card.normal >
    <div class="d-flex">
        <p class="d-flex flex-column">
            <span class="text-bold text-lg">{{$allDayCount ?? 0}}</span>
            <span>{{__('admin/blogPost.dash_count_week')}}</span>
        </p>
    </div>
    <div class="position-relative mb-4">
        <canvas id="visitors-chart" height="200"></canvas>
    </div>
</x-admin.card.normal>

@push('JsCode')
    <script>
        $(function () {
            'use strict'

            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $visitorsChart = $('#visitors-chart')

            var visitorsChart = new Chart($visitorsChart, {
                data: {
                    labels: [{!!  $dayList !!}],
                    datasets: [{
                        type: 'line',
                        data: [{{$dayCountList}}],
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        pointBorderColor: '#007bff',
                        pointBackgroundColor: '#007bff',
                        fill: false,
                    },
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: 10
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        })
    </script>
@endpush
