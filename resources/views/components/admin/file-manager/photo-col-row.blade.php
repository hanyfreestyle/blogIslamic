@foreach($photoUrl as $url)
    @if($viewType == 'editor' or $viewType == 'admin')
        @if(!in_array($url,$dbPhotos))
            <div class="col-lg-2 parent_div mb-2">
                <div class="fileBrowserPhotoDiv">
                    <img class="img-fluid img-thumbnail" src="{{$url}}">
                </div>
                @can($PrefixRole.'_edit')
                    @if($viewType == 'editor')
                        <div class="btn_div">
                            <button class="btn" onclick="returnFileUrl('{{$url}}')"><i class="fas fa-plus-circle"></i></button>
                        </div>
                    @elseif($viewType == 'admin')
                        <div class="btn_div">
                            <button class="btn remove removeOrUpdatePhoto" id="{{$url}}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    @endif
                @endcan
            </div>
        @endif
    @elseif($viewType == 'DeletePhoto')
        @if(in_array($url,$dbPhotos))
            <div class="col-lg-2 parent_div">
                <div class="fileBrowserPhotoDiv">
                    <img class="img-fluid img-thumbnail" src="{{$url}}">
                </div>
                @can($PrefixRole.'_edit')
                    <div class="btn_div">
                        <button class="btn add_btn removeOrUpdatePhoto" id="{{$url}}"><i class="fas fa-plus-circle"></i></button>
                    </div>
                @endcan
            </div>
        @endif
    @endif
@endforeach

