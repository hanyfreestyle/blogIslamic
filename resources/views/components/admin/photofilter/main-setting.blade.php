<x-admin.card.normal title="{{__('admin/config/upFilter.form_main_setting')}}">
  <div class="row">
    <x-admin.form.but-on-off name="convert_state" value="{{old('convert_state',$row->convert_state)}}"
                             label="{{__('admin/config/upFilter.form_convert_state')}}" colrow="col-lg-7"/>
    <x-admin.form.input :row="$row" name="quality_val" :label="__('admin/config/upFilter.form_quality_val')" :horizontal-label="true"
                        col="5" tdir="dir_en"/>
  </div>
  <hr>
  <div class="row">
    <x-admin.form.input :row="$row" name="name" :label="__('admin/config/upFilter.form_name')" col="5" tdir="ar"/>
    <x-admin.form.select-arr name="type" sendvalue="{{old('type',$row->type)}}" :send-arr="$filterTypeArr"
                             label="{{__('admin/config/upFilter.form_type')}}" colrow="col-lg-7"/>
  </div>
  <div class="row">
    <x-admin.form.input :row="$row" name="new_w" :label="__('admin/config/upFilter.form_new_w')" col="4" tdir="en"/>
    <x-admin.form.input :row="$row" name="new_h" :label="__('admin/config/upFilter.form_new_h')" col="4" tdir="en"/>
    <x-admin.form.input-color :row="$row" name="canvas_back" :label="__('admin/config/upFilter.form_canvas_back')"/>
  </div>
</x-admin.card.normal>

@if(count($rowDataSize) > 0)
  <x-admin.card.normal title="{{__('admin/config/upFilter.form_more_photo')}}" :add-form-error="false">
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-wrap">
        <thead>
        <tr>
          <th>{{__('admin/config/upFilter.form_type')}}</th>
          <th>{{__('admin/config/upFilter.form_new_w')}}</th>
          <th>{{__('admin/config/upFilter.form_new_h')}}</th>
          <x-admin.table.action-but po="top" type="edit"/>
          <x-admin.table.action-but po="top" type="delete"/>
        </tr>
        </thead>
        <tbody>
        @foreach($rowDataSize as $DataSize)
          <tr>
            <td>{{ $filterTypeArr[$DataSize->type]['name']}}</td>
            <td class="text-center">{{$DataSize->new_w}}</td>
            <td class="text-center">{{$DataSize->new_h}}</td>
            @can($PrefixRole.'_edit')
              <td class="td_action">
                <x-admin.form.action-button url="{{route('admin.config.upFilter.size.edit',$DataSize->id)}}" type="edit" :tip="true"/>
              </td>
            @endcan
            @can($PrefixRole.'_delete')
              <td class="td_action">
                <x-admin.form.action-button id="{{route('admin.config.upFilter.size.destroy',$DataSize->id)}}" type="deleteSweet" url="#"/>
              </td>
            @endcan
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </x-admin.card.normal>
@endif
@can($PrefixRole.'_add')
  @if(intval($row->id)!= '0' and  count($rowDataSize) < 2 )
    <hr>
    <x-admin.form.action-button url="{{route($PrefixRoute.'.size.create',$row->id)}}"
                                print-lable="{{__('admin/config/upFilter.form_add_new_size')}}" size="m" :tip="false"/>
    <hr>
  @endif
@endcan
