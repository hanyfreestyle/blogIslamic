<div>
  @if(count($addresses) == 1)
    <input type="hidden" name="address_id" value="{{$addresses[0]->uuid}}">
    <x-temp.cart.none-user-form :address="$addresses[0]" />
  @else
    <div class="form-group mb-3">
      <div class="custom_select">
        <select wire:change="changeEvent($event.target.value)" class="form-control address_id" name="address_id" >
          @foreach($addresses as $address)
            <option value="{{$address->uuid}}" @if($address->is_default) selected @endif >{{$address->name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <x-temp.cart.none-user-form :address="$printAddress" />
  @endif
</div>
