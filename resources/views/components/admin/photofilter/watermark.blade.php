<x-admin.card.normal title="{{__('admin/config/upFilter.form_watermark_setting')}}">
  <div class="row">
    <x-admin.form.select-arr name="watermark_state" colrow="col-lg-5" select-type="selActive"
                             label="{{__('admin/config/upFilter.form_watermark_state')}}"
                             sendvalue="{{old('watermark_state',$row->watermark_state)}}"/>

    <x-admin.form.select-arr name="watermark_position" label="{{__('admin/config/upFilter.form_watermark_position')}}" colrow="col-lg-7"
                             :send-arr="config('adminVar.watermarkPositionArr')"
                             sendvalue="{{old('watermark_position',$row->watermark_position)}}"/>
  </div>
  <hr>
  <div class="row">
    <x-admin.form.select-arr name="watermark_img" label="{{__('admin/config/upFilter.form_watermark_img')}}" colrow="col-lg-12"
                             select-type="file"
                             sendvalue="{{old('watermark_img',$row->watermark_img)}}" :send-arr="config('adminVar.logoFileList')"/>
  </div>
  <hr>
  <div class="form-group row">
    <label class="col-md-12 col-form-label">{{__('admin/config/upFilter.form_watermark_img')}}</label>
    <div class="col-md-12">
      <div class="watermark_imgView">
        <img id="imageused" class="" src="{!! $printphoto !!}">
      </div>
      <input type="hidden" id="app_path" class="form-control force_ltr" value="{{ app('url')->asset("/")}}">
    </div>
  </div>
</x-admin.card.normal>
