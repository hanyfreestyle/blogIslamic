<div>
  <x-site.def.wire-loading/>
  @if(count($products) == 0)
    <div class="col-lg-12">
      <div class="text-center wish_list_page_no_data">
        <h2 class="">{{__('web/product.wishlistn_nodata_h1')}}</h2>
        <p>{!! nl2br(__('web/product.wishlistn_nodata_p')) !!} </p>
        <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="no_data" def-name="photo" alt="nodata" class="img-fluid" :lazy-active="false"/>
      </div>
    </div>
  @else
    <div class="col-lg-12 order-2 col-12" wire:loading.remove>
      <div class="kalles-section tp_se_cdt">
        <div class="{{$proStyle['cardStyleHolder']}}">
          @foreach($products as $product)
            <x-temp.products.card remove-from="favPage" :quick-shop="false" :product="$product"/>
          @endforeach
        </div>
        <div class="products-footer tc mt__40">
          <x-site.def.pagination :rows="$products"/>
        </div>
      </div>
    </div>
  @endif
</div>