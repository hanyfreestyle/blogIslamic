@if( $count == '0')
    <a href="{{$url}}" class="btn bg-dark btn-app btn_app_new rounded"><i class="{{ $icon }}"></i> {{ $name }}</a>
@else
    <a href="{{$url}}" class="btn btn-app btn_app_new bg-primary rounded">
        <span class="badge bg-dark"><strong>{{ $count }}</strong> </span>
        <i class="{{ $icon }}"></i> {{ $name }}
    </a>
@endif
