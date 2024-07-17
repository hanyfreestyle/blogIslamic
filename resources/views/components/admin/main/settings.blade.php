<form class="mainForm pb-0" action="{{route('admin.config.model.update')}}" method="post">
  @csrf
  <input type="hidden" value="{{$modelname}}" name="model_id">
  <input type="hidden" value="{{$PrefixRoute}}" name="PrefixRoute">
  <div class="row">
    <input type="hidden" value="{{$modelname}}" name="model_id">

    <x-admin.form.input label="{{__('admin/config/settings.set_perpage')}}" name="{{$modelname}}_perpage" :requiredSpan="true" col="3"
                        dir="ar"
                        value="{{old($modelname.'_perpage',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_perpage',10))}}"
                        inputclass="dir_ar"/>

    @if($filterid and $selectfilterid)
      <x-admin.form.select-arr :label="__('admin/config/settings.set_filter_form')" name="{{$modelname}}_select_filter_form" col="3"
                               sendvalue="{{old($modelname.'_select_filter_form',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_select_filter_form',0))}}"
                               select-type="selActive"/>
    @endif

    @if($labelView)
      <x-admin.form.select-arr label="{{__('admin/config/settings.set_label_view')}}" name="{{$modelname}}_label_view" col="3"
                               sendvalue="{{old($modelname.'_label_view',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_label_view',1))}}"
                               select-type="selActive"/>
    @endif

    @if($datatable)
      <x-admin.form.select-arr label="{{__('admin/config/settings.set_datatable')}}" name="{{$modelname}}_datatable" col="3"
                               sendvalue="{{old($modelname.'_datatable',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_datatable',1))}}"
                               select-type="selActive"/>
    @else
      <input type="hidden" value="0" name="{{$modelname}}_datatable">
    @endif

    @if($editor)
      <x-admin.form.select-arr label="{{ __('admin/config/settings.set_editor') }}" name="{{$modelname}}_editor" col="3"
                               sendvalue="{{old($modelname.'_editor',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_editor',0))}}"
                               select-type="selActive"/>
    @else
      <input type="hidden" value="0" name="{{$modelname}}_editor">
    @endif


    @if($orderby)
      <x-admin.form.select-arr label="{{__('admin/config/settings.set_orderby')}}" name="{{$modelname}}_orderby" col="3"
                               :send-arr="$OrderByArr"
                               sendvalue="{{old($modelname.'_orderby',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_orderby',0))}}"
                               select-type="normal"/>
    @else
      <input type="hidden" value="{{$orderbyDef}}" name="{{$modelname}}_orderby">
    @endif

    @if($filterid)
      <x-admin.form.select-arr label="{{ __('admin/config/settings.set_filter_id') }}" name="{{$modelname}}_filterid" col="3"
                               sendvalue="{{old($modelname.'_filterid',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_filterid',0))}}"
                               :send-arr="$filterTypes"/>
    @endif

    @if($iconfilterid)
      <x-admin.form.select-arr label="{{ __('admin/config/settings.set_iconfilter_id') }}" name="{{$modelname}}_iconfilterid" col="3"
                               sendvalue="{{old($modelname.'_iconfilterid',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_iconfilterid',0))}}"
                               :send-arr="$filterTypes"/>
    @endif



    @if($morePhotoFilterid)
      <x-admin.form.select-arr label="{{ __('admin/config/settings.set_filter_filter_more_photo') }}"
                               name="{{$modelname}}_morephoto_filterid" col="3"
                               sendvalue="{{old($modelname.'_morephoto_filterid',\App\Helpers\AdminHelper::arrIsset($modelSettings,$modelname.'_morephoto_filterid',0))}}"
                               :send-arr="$filterTypes"/>
    @endif

    {{$slot}}
  </div>
  @if(isset($pageData['ModelId']))
    <input type="hidden" name="ModelId" value="{{$pageData['ModelId']}}">
  @endif

  <x-admin.form.submit-role-back :page-data="$pageData"/>
</form>
