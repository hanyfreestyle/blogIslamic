<form action="{{route('ContactSaveForm')}}" method="post" class="myForm">
  @csrf
  <input type="hidden" name="request_type" value="{{$requestType}}">
  <h2 class="">{{ $formTitle }}</h2>
  <div class="hr-dashed my-4"></div>

  <div class="form-row">
    <x-site.form.input name="name" label="{{__('web/contact.form_name')}}"  value="{{old('name')}}" />
    <x-site.form.phone name="phone" value="{{old('phone')}}" label="{{__('web/contact.form_phone')}}" />
  </div>

  <div class="form-row">
    <x-site.form.input  name="subject"  label="{{__('web/contact.form_subject')}}" value="{{old('subject')}}" col="12" />
  </div>

  <div class="form-row">
    <x-site.form.text-area value="{{old('message')}}" col="12" label="{{__('web/contact.form_message')}}" />
  </div>

  <div class="form-row">
    <button class="btn btn-primary send_but" type="submit">{{__('web/contact.form_send')}}</button>
  </div>
</form>

