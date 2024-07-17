<div class="{{$col}}">
    <div class="small-box bg-{{$bg}}">
        <div class="inner">
            <h3>{{number_format($count)}}</h3>
            <p>{{$title}}</p>
        </div>

        @if($icon)
            <div class="icon">
                <i class="{{$icon}}"></i>
            </div>
        @endif

        @if($url)
            <a href="{{$url}}" class="small-box-footer">{{__('admin/def.details')}} <i class="fas fa-arrow-circle-right"></i></a>
        @else
            <a href="#" class="small-box-footer" style="min-height: 30px"> </a>
        @endif

    </div>
</div>
