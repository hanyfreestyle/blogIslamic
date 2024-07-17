@can($PrefixRole."_delete")
  @if(count($row->translations) > 1 and count(config('app.web_lang')) > 1 )
    <div class="btn-group">
      <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
              data-toggle="dropdown"> {{__('admin.multiple_lang_del_h1')}}</button>
      <div class="dropdown-menu" role="menu">
        @foreach($row->translations as $Lang)
          @if($Lang->locale == 'ar')
            <a class="dropdown-item sweet_daleteBtn_noForm" href="#"
               id="{{route($PrefixRoute.'.DeleteLang',$Lang->id)}}">{{__('admin.multiple_lang_del_ar')}}</a>
          @endif
          @if($Lang->locale == 'en')
            <a class="dropdown-item sweet_daleteBtn_noForm" href="#"
               id="{{route($PrefixRoute.'.DeleteLang',$Lang->id)}}">{{__('admin.multiple_lang_del_en')}}</a>
          @endif
        @endforeach
      </div>
    </div>
  @endif
@endcan
