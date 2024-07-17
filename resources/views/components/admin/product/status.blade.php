@if($viewtype == 'Add')
  <input type="hidden" name="is_active" value="1">
  <input type="hidden" name="is_archived" value="0">
  <input type="hidden" name="featured" value="0">
  <input type="hidden" name="on_stock" value="1">
  <input type="hidden" name="type" value="1">
@elseif($viewtype == 'Edit')
  <x-admin.card.normal>
    <div class="row">

      <x-admin.form.select-arr name="is_active" sendvalue="{{old('is_active',$row->is_active)}}" select-type="selActive" col="12"
                               label="{{__('admin/proProduct.pro_status_is_active')}}"/>

      <x-admin.form.select-arr name="featured" sendvalue="{{old('featured',$row->featured)}}" select-type="selActive" col="12"
                               label="{{__('admin/proProduct.pro_featured')}}"/>
      <x-admin.form.select-arr name="is_archived" sendvalue="{{old('is_archived',$row->is_archived)}}" :labelview="true"
                               :send-arr="$IsArchived_Arr" label="{{__('admin/proProduct.pro_is_archived_t')}}" col="12"/>

      <x-admin.form.select-arr name="on_stock" sendvalue="{{old('on_stock',$row->on_stock)}}" :labelview="true"
                               :send-arr="$OnStock_Arr" label="{{__('admin/proProduct.pro_status_stock')}}" col="12"/>

    </div>
  </x-admin.card.normal>
@endif

