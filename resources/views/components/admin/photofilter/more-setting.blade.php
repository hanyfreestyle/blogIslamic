<x-admin.card.normal title="{{__('admin/config/upFilter.form_more_setting')}}">
    <div class="row">
        <x-admin.form.but-on-off label="{{__('admin/config/upFilter.form_greyscale')}}" name="greyscale" value="{{old('greyscale',$row->greyscale)}}" />
    </div>
    <hr>
    <div class="row">
        <x-admin.form.but-on-off label="{{__('admin/config/upFilter.form_flip_state')}}" name="flip_state" value="{{old('flip_state',$row->flip_state)}}" />
        <x-admin.form.but-on-off label="{{__('admin/config/upFilter.form_flip_v')}}" name="flip_v" value="{{old('flip_v',$row->flip_v)}}" />
    </div>
    <hr>
    <div class="row">
        <x-admin.form.but-on-off label="{{__('admin/config/upFilter.form_blur')}}" name="blur" value="{{old('blur',$row->blur)}}" />
        <x-admin.form.input label="{{__('admin/config/upFilter.form_blur_size')}}" name="blur_size" :horizontal-label="true" :requiredSpan="true" colrow="col-lg-5"
                            value="{{old('blur_size',$row->blur_size)}}" inputclass="dir_en"/>
    </div>
    <hr>
    <div class="row">
        <x-admin.form.but-on-off label="{{__('admin/config/upFilter.form_pixelate')}}" name="pixelate" value="{{old('pixelate',$row->pixelate)}}" />
        <x-admin.form.input label="{{__('admin/config/upFilter.form_pixelate_size')}}" name="pixelate_size" :horizontal-label="true" :requiredSpan="true" colrow="col-lg-5"
                            value="{{old('pixelate_size',$row->pixelate_size)}}" inputclass="dir_en"/>
    </div>
</x-admin.card.normal>
