<div class="bg-neutral-0 rounded-4 p-6 FormDiv SiteBoxShadow">
    <form action="{{route($defroute)}}" method="post" class="mainform" >
        @csrf
        <input type="hidden" name="request_type"  value="2">
        <input type="hidden" name="form_id"  value="{{$formId}}">

        <div class="row g-4">
            <input type="hidden" name="listing_id" value="{{$row->id}}" >
            <input type="hidden" name="project_id" value="{{$row->parent_id}}" >

            <x-admin.form.input name="name{{$formId}}" value="{{old('name'.$formId)}}" colrow="col-lg-5 col-12"
                                label="{{__('web/contact.form_name')}}" :labelview="false" :placeholder="true" dir="ar"  />

            <x-admin.form.input-phone name="phone{{$formId}}" id="{{$formId}}" value="{{old('phone'.$formId)}}" label="{{__('web/contact.form_phone')}}" colrow="col-lg-5 col-12"  />
            <div class="col-lg-2 col-12">
                <button  class="btn btn-primary send_but_onpage" type="submit">{{__('web/contact.form_h1_request')}}</button>
            </div>
        </div>
    </form>
</div>
