@can($PrefixRole."_add")
  @if($pageData['WithSubCat'] == true and intval($pageData['ModelId']) > 0 )
    <div class="btn-group">
      <button type="button" class="btn btn-sm btn-info dropdown-toggle"
              data-toggle="dropdown">{{__('admin.multiple_lang_menu_h1')}}</button>
      <div class="dropdown-menu" role="menu">
        <a class="dropdown-item"
           href="{{route($PrefixRoute.'.create_ar',intval($pageData['ModelId']))}}">{{__('admin.multiple_lang_menu_ar')}}</a>
        <a class="dropdown-item"
           href="{{route($PrefixRoute.'.create_en',intval($pageData['ModelId']))}}">{{ __('admin.multiple_lang_menu_en') }}</a>
      </div>
    </div>
  @else
    <div class="btn-group">
      <button type="button" class="btn btn-sm btn-info dropdown-toggle"
              data-toggle="dropdown">{{__('admin.multiple_lang_menu_h1')}}</button>
      <div class="dropdown-menu" role="menu">
        <a class="dropdown-item" href="{{route($PrefixRoute.'.create_ar')}}">{{__('admin.multiple_lang_menu_ar')}}</a>
        <a class="dropdown-item" href="{{route($PrefixRoute.'.create_en')}}">{{ __('admin.multiple_lang_menu_en') }}</a>
      </div>
    </div>
  @endif
@endcan
