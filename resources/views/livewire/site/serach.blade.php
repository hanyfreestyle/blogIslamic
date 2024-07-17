@if($type == 'on_page')
  <div class="nt_mini_cart flex column h__100">
    <div class="mini_cart_wrap">
      <form method="get" class="search_header mini_search_frm js_frm_search pr " role="search">
        <div class="row">
          <div class="frm_search_input pr oh col mt__15">
            <input class="search_header__input js_iput_search" autocomplete="off" type="text" wire:model.debounce.500ms="search" placeholder="{{__('web/product.search_placeholder')}}">
            <button class="search_header__submit js_btn_search use_jsfull hide_  pe_none" type="submit">
              <i class="iccl iccl-search"></i></button>
          </div>
        </div>
        <i class="close_pp pegk pe-7s-close ts__03 cd pa r__0 serach_close_pp"></i>
        <div class="ld_bar_search"></div>
      </form>

      <div class="search_header__content mini_cart_content fixcl-scroll widget">
        <div class="fixcl-scroll-content product_list_widget">

          <div class="col-lg-12 search_loading text-center mt__40" wire:loading>
            <img src="{{url('assets/web/img/loading.gif')}}">
          </div>

          <div class="js_prs_search row fl_centerC" wire:loading.remove>
            @if(count($products)>0)
              @foreach($products as $product)
                <x-temp.products.card-search :product="$product"/>
              @endforeach
            @else
              @if($open == 1)
                <div class="col-lg-12 search_start text-center">
                  <div class="icon">
                    <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="search_start" def-name="photo" alt="search" :lazy-active="false"/>
                  </div>
                </div>
              @else
                <div class="col-lg-12 no_result mt__40 text-center">
                  <div class="alert  alert-warning alert-dismissible">
                    {{__('web/product.search_no_data')}}
                  </div>
                  <div class="icon mt__40">
                    <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="no_result" def-name="photo" alt="search" :lazy-active="false"/>
                  </div>
                </div>
              @endif
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@elseif($type == 'off_page')
<div class="off_page_search">

  <form method="get" class="search_header mt__20 pr" role="search">
    <div class="row">
      <div class="frm_search_input pr oh col">
        <input class="search_header__input js_iput_search" autocomplete="off" type="text" wire:model.debounce.500ms="search" placeholder="{{__('web/product.search_placeholder')}}">
        <button class="search_header__submit js_btn_search use_jsfull hide_  pe_none" type="submit">
          <i class="iccl iccl-search"></i></button>
      </div>
    </div>
  </form>

  <div class="col-lg-12 search_loading text-center" wire:loading>
    <img src="{{url('assets/web/img/loading.gif')}}">
  </div>

  <div class="row fl_centerC" wire:loading.remove>
    @if(count($products)>0)
      @foreach($products as $product)
        <x-temp.products.card-search :product="$product"/>
      @endforeach
    @else
      @if($open == 1)
        <div class="col-lg-12 search_start text-center">
          <div class="icon">
            <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="search_start" def-name="photo" alt="search" :lazy-active="false"/>
          </div>
        </div>
      @else
        <div class="col-lg-12 no_result mt__40 text-center">
          <div class="alert  alert-warning alert-dismissible">
            {{__('web/product.search_no_data')}}
          </div>
          <div class="icon mt__40">
            <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="no_result" def-name="photo" alt="search" :lazy-active="false"/>
          </div>
        </div>
      @endif
    @endif
  </div>

</div>

@endif

