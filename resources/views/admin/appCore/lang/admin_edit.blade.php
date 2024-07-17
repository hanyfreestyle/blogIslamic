@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :page-data="$pageData"/>
  <x-admin.hmtl.section>
    <x-admin.form.select-arr :send-arr="$listFile" name="selectfile" :sendvalue="$selId"
                             :label="__('admin.lang_select_file')" print-val-name="name_{{thisCurrentLocale()}}"  :labelview="false"/>
    <x-admin.card.def :page-data="$pageData">
      @if($ViewData == 1)
        @if(isset($_GET['id']))

          <form action="{{route($PrefixRoute.'.updateFile')}}" method="post">
            @csrf
            <input type="hidden" value="{{$_GET['id']}}" name="file_id">
            <hr>
            @foreach($mergeData as $key=>$val)
              <div class="row {{isSetKeyForLang($key)}}">
                <div class="col-3">
                  @if(config('app.development'))
                    <input type="text" class="form-control dir_en" value="{{$key}}" name="key[]">
                  @else
                    <div class="text-left font-weight-bold pt-2">{{$key}}</div>
                    <input type="hidden" class="form-control dir_en" value="{{$key}}" name="key[]">
                  @endif
                </div>
                @foreach(config('app.admin_lang') as $langkey=>$lang )
                  <div class="col-4">
                    <input type="text" class="form-control @if($langkey == 'en') dir_en @endif"
                           value="{!! AdminHelper::arrIsset($allData[$langkey],$key,"") !!}" name="{{$langkey}}[]">
                  </div>
                @endforeach

                @if(config('app.development'))
                  <div class="col-1">
                    <a href="#" thisid="custmid_{{$loop->index}}" class="btn btn-sm btn-primary copyThisText"><i
                       class="fa fas fa-copy"></i></a>
                    <input value="__('{{$prefixCopy.$key}}')" id="custmid_{{$loop->index}}" type="hidden">

                    <a href="#" thisid="Newcustmid_{{$loop->index}}" class="btn btn-sm btn-dark copyThisText"><i
                       class="fa fas fa-copy"></i></a>
                    <input value="{{$prefixCopy.$key}}" id="Newcustmid_{{$loop->index}}" type="hidden">
                  </div>
                @endif

              </div>
              <hr>
            @endforeach

            @if(config('app.development'))
              <div id="newinput"></div>
              <div class="row">
                <button id="rowAdder" type="button" class="btn btn-dark">{{__('admin.lang_add_new_key')}}</button>
              </div>
            @endif
            @can('adminlang_view')
              <hr>
              <x-admin.form.submit text="Update"/>
            @endcan
          </form>
        @endif
      @else
        <x-admin.hmtl.alert-massage type="nodata"/>
      @endif
    </x-admin.card.def>
  </x-admin.hmtl.section>
@endsection

@push('JsCode')
  <x-admin.java.copy-this-text/>
  <x-admin.java.add-new-lang-row/>
  <script>
      $('#selectfile').change(function () {
          var idSel = this.value;
          window.location = "{{ route($PrefixRoute.'.edit','id=') }}" + idSel;
      });
  </script>
@endpush
