@if(count(config('app.web_lang')) > 1 )
  @if($modelid)
    @if(!isset($row->translate('ar')->name))
      <td class="td_action">
        <x-admin.form.action-button url="{{route($PrefixRoute.'.editAr',[$modelid,$row->id])}}" icon="fa-solid fa-globe" :tip="true"
                                    print-lable="{{__('admin.multiple_lang_menu_ar')}}"/>
      </td>
    @elseif(!isset($row->translate('en')->name))
      <td class="td_action">
        <x-admin.form.action-button url="{{route($PrefixRoute.'.editEn',[$modelid,$row->id])}}" icon="fa-solid fa-globe" :tip="true"
                                    print-lable="{{__('admin.multiple_lang_menu_en')}}"/>
      </td>
    @else
      <td class="td_action"></td>
    @endif
  @else
    @if(!isset($row->translate('ar')->name))
      <td class="td_action">
        <x-admin.form.action-button url="{{route($PrefixRoute.'.editAr',$row->id)}}" icon="fa-solid fa-globe" :tip="$tip"
                                    print-lable="{{__('admin.multiple_lang_menu_ar')}}"/>
      </td>
    @elseif(!isset($row->translate('en')->name))
      <td class="td_action">
        <x-admin.form.action-button url="{{route($PrefixRoute.'.editEn',$row->id)}}" icon="fa-solid fa-globe" :tip="$tip"
                                    print-lable="{{__('admin.multiple_lang_menu_en')}}"/>
      </td>
    @else
      <td class="td_action"></td>
    @endif

  @endif
@endif
