<x-admin.form.input name="regular_price" :row="$row" tdir="en" :req="false" col="3" :label="__('admin/proProduct.pro_text_regular_price')"/>
<x-admin.form.input name="price" :row="$row" col="3" tdir="en" :label="__('admin/proProduct.pro_text_price')"/>

@if($viewtype == 'Add')
  <input type="hidden" name="sales_count" value="1">
@elseif($viewtype == 'Edit')
  <x-admin.form.input name="sales_count" :row="$row" col="3" tdir="en" :label="__('admin/proProduct.pro_sales_count')"/>
@endif



{{--<x-admin.form.input name="qty_left" :row="$row" col="3" tdir="en" :req="false" :label="__('admin/proProduct.pro_text_qty')"/>--}}
{{--<x-admin.form.input name="qty_max" :row="$row" col="3" tdir="en" :req="false" :label="__('admin/proProduct.pro_text_qty_max')"/>--}}