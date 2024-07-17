@if( $type =='Normal' )
    @if($lazyActive)
        <img data-src="{{getPhotoPath($row->photo_thum_1,$def,$defName)}}" alt="{{$row->$alt}}" title="{{$row->$alt}}" class="lazy {{$class}}" @if($w) width="{{$w}}" @endif @if($h) height="{{$h}}" @endif >
    @else
        <img src="{{getPhotoPath($row->photo_thum_1,$def,$defName)}}" alt="{{$row->$alt}}" title="{{$row->$alt}}" class="{{$class}}" @if($w) width="{{$w}}" @endif @if($h) height="{{$h}}" @endif >
    @endif

@elseif($type =='DefPhotoList')
    @if($lazyActive)
        <img data-src="{{getDefPhotoPath($row,$def,$defName)}}" alt="{{$alt}}" title="{{$alt}}" class="lazy {{$class}}" @if($w) width="{{$w}}" @endif @if($h) height="{{$h}}" @endif >
    @else
        <img src="{{getDefPhotoPath($row,$def,$defName)}}" alt="{{$alt}}" title="{{$alt}}" class="{{$class}}" @if($w) width="{{$w}}" @endif @if($h) height="{{$h}}" @endif >
    @endif
@endif


