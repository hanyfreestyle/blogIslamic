<div class="border-bottom header-top">
  <div class="container">
    <div class="row">
      <div class="col-12">

        <div class="topHeader">
          <a href="{{route('page_index')}}" class="">
            <img data-src="{{getDefPhotoPath($DefPhotoList,'dark_logo')}}" alt="logo" width="516" height="60"
                 class="lazy top_header_logo">
          </a>

          <ul class="list_topheader">
            <li class="">
              <a href="{{ LaravelLocalization::getLocalizedURL(webChangeLocale(),$pageView['go_home']) }}" class="">
                <i class="fa-solid fa-globe language"></i>
              </a>
            </li>
            <li class="d-none d-lg-block descMenu">
              <a href="tel:{{$WebConfig->phone_call}}" class="">{{$WebConfig->phone_num}}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
