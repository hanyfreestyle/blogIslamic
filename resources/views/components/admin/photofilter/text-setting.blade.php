<x-admin.card.normal title="{{__('admin/config/upFilter.form_text_setting')}}" :add-form-error="false"   >
    <div class="row">
        <x-admin.form.select-arr   label="{{__('admin/config/upFilter.form_text_state')}}" name="text_state" colrow="col-lg-5"
                                   sendvalue="{{old('text_state',$row->text_state)}}" select-type="selActive" />

        <x-admin.form.input label="{{__('admin/config/upFilter.form_text_print')}}" name="text_print" :requiredSpan="true"   colrow="col-lg-7"
                            value="{{old('text_print',$row->text_print)}}" inputclass="dir_en"/>

    </div>
    <hr>
    <div class="row">
        <x-admin.form.select-arr   label="{{__('admin/config/upFilter.form_font_path')}}" name="font_path" colrow="col-lg-6" select-type="file"
                                   sendvalue="{{old('font_path',$row->font_path)}}" :send-arr="config('adminVar.fontFileList')"/>

        <x-admin.form.select-arr   label="{{__('admin/config/upFilter.form_text_position')}}" name="text_position" colrow="col-lg-6"
                                   sendvalue="{{old('text_position',$row->text_position)}}" :send-arr="config('adminVar.textPositionArr')"/>
    </div>
    <hr>
    <div class="row">
        <x-admin.form.input label="{{__('admin/config/upFilter.form_font_size')}}" name="font_size" :requiredSpan="true"   colrow="col-lg-4"
                            value="{{old('font_size',$row->font_size)}}" inputclass="dir_en"/>
        <x-admin.form.input label="{{__('admin/config/upFilter.form_font_opacity')}}" name="font_opacity" :requiredSpan="true"   colrow="col-lg-4"
                            value="{{old('font_opacity',$row->font_opacity)}}" inputclass="dir_en"/>
        <x-admin.form.input-color name="font_color" label="{{__('admin/config/upFilter.form_font_color')}}" value="{{old('font_color',$row->font_color)}}" />
    </div>
</x-admin.card.normal>
