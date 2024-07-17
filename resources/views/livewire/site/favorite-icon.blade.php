@if($wishList == 'login')
  @if($fromwhere == 'card')
    <div class="pa ts__03 favicons nt_add_w">
      <a href="#" data-id="#nt_login_canvas" data-dismiss="modal" class="heart_icon cb chp push_side"><i class="facl"></i></a>
    </div>
  @elseif($fromwhere == 'ViewPro')
    <div class="pa ts__03 favicons nt_add_w">
      <a href="#" data-id="#nt_login_canvas" data-dismiss="modal" class="heart_icon cb chp push_side"><i class="facl"></i></a>
    </div>


  @endif
@else
  @if($fromwhere == 'card')
    <div wire:loading.remove>
      @if($wishList->where("product_id", $product->id)->count() == '0')
        <div class="pa ts__03 favicons nt_add_w">
          <a href="#" wire:click="addToWishList({{$product->id}})" class="heart_icon cb chp"><i class="facl"></i></a>
        </div>
      @else
        <div class="pa ts__03 favicons nt_add_w">
          <a href="#" wire:click="removeFromWishList({{$product->id}})" class="trash_icon"><i class="facl"></i></a>
        </div>
      @endif
    </div>
  @elseif($fromwhere == 'ViewPro')

    @if($wishList->where("product_id", $product->id)->count() == '0')
      <div class="nt_add_w ts__03 pa order-3 favicons" wire:loading.remove>
        <a href="#" wire:click="addToWishList({{$product->id}})" class="heart_icon wishlistadd cb chp "><i class="facl facl-heart-o"></i></a>
      </div>
    @else
      <div class="nt_add_w ts__03 pa order-3 favicons" wire:loading.remove>
        <a href="#" wire:click="removeFromWishList({{$product->id}})" class="trash_icon cb chp "><i class="facl facl-trash"></i></a>
      </div>
    @endif

  @endif

@endif



