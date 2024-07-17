<x-admin.hmtl.section>
  @if($pageData['ViewType'] == 'Edit')
    <div class="row mb-3">
      <div class="col-5">
        <h1 class="def_h1_new">{!! print_h1($row) !!}</h1>
      </div>
      <div class="col-7 dir_button">
        @if(count($row->childproduct) == 0)
          <x-admin.form.action-button url="{{route('admin.Shop.Product.manage-attribute',$row->id)}}" :print-lable="__('admin/proProduct.pro_variant_add')" :tip="false"/>
        @else
          <x-admin.form.action-button url="{{route('admin.Shop.Product.manage-attribute',$row->id)}}" :print-lable="__('admin/proProduct.pro_variant_manage')" :tip="false"/>
        @endif
        <x-admin.lang.add-new-button :row="$row" :tip="false"/>
        <x-admin.lang.delete-button :row="$row"/>
        <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$row->id)}}" type="morePhoto"/>
        @if($webSlug != '#' and $row->slug)
          <x-admin.form.action-button url="{{route($webSlug,$row->slug)}}" type="webView" :tip="false"/>
        @endif
      </div>
    </div>

  @elseif( $pageData['ViewType'] == 'ManageAttribute')
    <div class="row mb-3">
      <div class="col-5">
        <h1 class="def_h1_new">{!! print_h1($row) !!}</h1>
      </div>
      <div class="col-7 dir_button">
        <x-admin.form.action-button url="{{route($PrefixRoute.'.edit',$row->id)}}" type="back" :tip="false"/>
      </div>
    </div>
  @endif
</x-admin.hmtl.section>
