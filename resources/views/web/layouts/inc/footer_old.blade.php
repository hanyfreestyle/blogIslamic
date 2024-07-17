<div class=" WebFooter">
    <div class="container">
        <div class="row justify-content-md-center ">
            <div class="col-md-6 col-lg-6">
                <a href="{{route('page_index')}}" class="link d-inline-block mb-6">
                    <img data-src="{{getDefPhotoPath($DefPhotoList,'light_logo')}}" width="516" height="60" alt="logo" class="lazy footer_logo img-fluid">
                </a>
                <p class="clr-neutral-30 mb-6 footer_text"> {{__('web/layout.footer_text')}}</p>
                <ul class="footer_social">
                    @if($WebConfig->facebook)
                        <li>
                            <a href="{{$WebConfig->facebook}}" aria-label="facebook" target="_blank" class="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                    @endif

                    @if($WebConfig->twitter)
                        <li>
                            <a href="{{$WebConfig->twitter}}" aria-label="twitter" target="_blank" class="">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                    @endif

                    @if($WebConfig->youtube)
                        <li>
                            <a href="{{$WebConfig->youtube}}" aria-label="youtube" target="_blank" class="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    @endif

                    @if($WebConfig->instagram)
                        <li>
                            <a href="{{$WebConfig->instagram}}" aria-label="instagram" target="_blank" class="">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-6 col-lg-2"></div>
            <div class="col-md-6 col-lg-4 mobile_footer_p mb-5">
                <livewire:site.news-letter-form />
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row footer_copy_right">
            <div class="col-12">
                <div class="py-8 border-top">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-12 mobile_footer_p_bottom">
                            <p class="m-0 text-center text-lg-center "> {!! GetCopyRight('2008',$WebConfig->name ) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($pageView['show_fix'] == true)

    <div class="fixDiv d-xl-none">
        <div class="sticky-navbar fixed d-xl-none">

            <div class="sticky-info">
                <a href="{{route('page_index')}}" class="sticky_a @if($pageView['SelMenu'] == 'HomePage') sticky_active @endif " >
                    <i class="fa-solid fa-house"></i>
                    {{__('web/menu.sticky_home')}}
                </a>
            </div>

            <div class="sticky-info">
                <a href="#" class="sticky_a  @if($pageView['SelMenu'] == 'Compounds') sticky_active @endif ">
                    <i class="fa-solid fa-building"></i>
                    {{ __('web/menu.sticky_project')}}
                </a>
            </div>
            <div class="sticky-info">
                <a  href="@" class="sticky_a @if($pageView['SelMenu'] == 'ForSale') sticky_active @endif">
                    <i class="fa-regular fa-sitemap"></i>
                    {{ __('web/menu.sticky_units') }}
                </a>
            </div>

            <div class="sticky-info">
                <div class="sticky_a btn01 @if($pageView['SelMenu'] == 'SelMenu') sticky_active @endif">
                    <i class="fa-solid fa-bars"></i>
                    {{ __('web/menu.sticky_menu') }}
                </div>
            </div>
        </div>
    </div>

@else

<div class="fixDiv d-xl-none">
    <div class="sticky_call_new">
        <x-site.contact.call-to-action-button :unit="$unit" view-type="FooterView"  :config="$WebConfig" />
    </div>
</div>

@endif


<nav class="side-slide">
    <h3 class="nav01">x</h3>
    <ul>
        <li class="menu-list {{activeMenu($pageView,'HomePage')}}"><a href="{{route('page_index')}}" class="link menu-link "> {{__('web/menu.main_home')}} </a> </li>
        <li class="menu-list {{activeMenu($pageView,'Contact')}} "><a href="{{ LaravelLocalization::localizeUrl(route('page_ContactUs')) }}" class="link menu-link "> {{__('web/menu.main_contatc_us')}} </a> </li>
    </ul>
</nav>


