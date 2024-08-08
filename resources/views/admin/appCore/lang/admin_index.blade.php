@extends('admin.layouts.app')
@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="true"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :page-data="$pageData"/>

  <x-admin.hmtl.section>
    <div class="content mb-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-9">
            <x-admin.form.select-arr :send-arr="$LangMenu" name="selectfile" :sendvalue="$selId"
                                     :label="__('admin.lang_select_file')" print-val-name="name_{{thisCurrentLocale()}}"
                                     :labelview="false"/>
          </div>
          @if(config('app.development'))
            @can('config_edit')
              <div class="col-3 dir_button">
                <x-admin.form.action-button url="{{route($PrefixRoute.'.edit')}}" print-lable="{{__('admin.lang_add_new_key')}}" size="m"
                                            :tip="false" bg="dark"/>
              </div>
            @endcan
          @endif
        </div>
      </div>
    </div>


  </x-admin.hmtl.section>

  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">

      @if(count($rowData)>0)
        <div class="card-body table-responsive p-0">
          <table id="MainDataTable" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Key</th>
              <th>File</th>
              @foreach(config('app.admin_lang') as $key =>$lang)
                <th>{{$lang}}</th>
              @endforeach
              @can('config_edit')
                <th></th>
              @endcan
              @if(config('app.development'))
                <th></th>
                <th></th>
              @endif
            </tr>
            </thead>
            <tbody>
            @foreach($rowData as $row)
              <tr>
                <td class="TD_100">{{$row['keyVar']}}</td>
                <td class="TD_100">{{$row['filekey']}}</td>
                @foreach(config('app.admin_lang') as $key =>$lang)
                  <th class="TD_300">{!! $row['name_'.$key] ?? '' !!}</th>
                @endforeach

                @can('config_edit')
                  <td class="TD_20">
                    <x-admin.form.action-button url="{!! route($PrefixRoute.'.edit', ['id'=>$row['filekey'],'key'=>$row['keyVar']] ) !!}"
                                                type="edit"/>
                  </td>
                @endcan
                @if(config('app.development'))
                  <td class="TD_20">
                    <input value="__('{{$row['prefixCopy']}}')" id="custmid_{{$loop->index}}" type="hidden">
                    <button onclick="copyToClipboard('custmid_{{$loop->index}}')" class="btn btn-sm btn-primary">
                      <i class="fa fas fa-copy"></i></button>
                  </td>

                  <td class="TD_20">
                    <input value="{{$row['prefixCopy']}}" id="Newcustmid_{{$loop->index}}" type="hidden">
                    <button onclick="copyToClipboard('Newcustmid_{{$loop->index}}')" class="btn btn-sm btn-dark">
                      <i class="fa fas fa-copy"></i></button>
                  </td>
                @endif


              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @else
        <x-admin.hmtl.alert-massage type="nodata"/>
      @endif
    </x-admin.card.def>
  </x-admin.hmtl.section>

@endsection

@push('JsCode')
  <script>

      function copyToClipboard(element) {
          var copyText = document.getElementById(element);
          copyText.readOnly = true;
          copyText.type = 'text';
          copyText.select();
          copyText.setSelectionRange(0, 99999); /* For mobile devices */
          navigator.clipboard.writeText(copyText.value);
          copyText.type = 'hidden';
      }


      $('#selectfile').change(function () {
          var idSel = this.value;
          window.location = "{{ route($PrefixRoute.'.index','id=') }}" + idSel;
      });
  </script>
  <x-admin.data-table.plugins :jscode="true" :is-active="true" :page-length="25"/>
@endpush

