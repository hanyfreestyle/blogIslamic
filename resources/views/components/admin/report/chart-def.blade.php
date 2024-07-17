<div class="My_Chart_Container">
    <div id="{{$id}}" class="placeholder"></div>
</div>
<div class="My_Chart_Legend {{$id}}"></div>


@push('JsCode')
    <script type="text/javascript">

        $(function () {
            var data = [
                    @foreach($dataRow as $data)
                {
                    label: "{{$data['name']}}", data: {{$data['count']}} , @if(issetArr($data,'setColor',false)) color:"{{$data['setColor']}}" @endif
                },
                @endforeach

            ];

            $.plot('#{{$id}}', data, {
                colors: ["#009900",'#0066CC', "#ff8154", "#878bb8", "#ffe989", "#4ac9b4"],
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.5,
                        label: {
                            show: true,
                            radius: 3 / 4,
                            formatter: labelFormatter,
                            background: {
                                opacity: 0.8,
                                color: '#000'
                            }
                        }
                    }
                },
                legend: {
                    show: true,
                    container: ".{{$id}}",
                }
            });

            function labelFormatter(label, series) {
                return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + Math.round(series.percent) + "%</div>";
            }
        });
    </script>
@endpush
