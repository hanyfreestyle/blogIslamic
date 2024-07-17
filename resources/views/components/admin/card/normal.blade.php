@if($isactive)
    <div class="{{$col}}" >
        <div class="card card-primary {{$outline_style}}">
            @if($title)
                <div class="card-header"><h3 class="card-title">{!! $title !!}</h3></div>
            @endif
            <div class="card-body">
                    {{$slot}}
            </div>
        </div>
    </div>
@endif

