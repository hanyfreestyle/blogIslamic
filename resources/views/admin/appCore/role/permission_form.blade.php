@extends('admin.layouts.app')

@section('content')

  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <x-admin.card.def :pageData="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($permission->id))}}" method="post"
            enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12">
          @if(config('app.development'))
            <div class="row">
              <x-admin.form.input label="{{__('admin/config/roles.permission_frname')}}" name="name" :requiredSpan="true" colrow="col-lg-4"
                                  value="{{old('name',$permission->name)}}" inputclass="dir_en"/>

              {{--                            <x-admin.form.select-arr  name="cat_id" label="{{__('admin/config/roles.model_name')}}" :sendvalue="old('cat_id',$permission->cat_id)" :send-arr="$modelsNameArr"/>--}}
            </div>
          @else
            <input type="hidden" name="name" value="{{$permission->name}}">
            <input type="hidden" name="cat_id" value="{{$permission->cat_id}}">
          @endif
          <div class="row">
            <x-admin.form.input label="{{__('admin/form.text_name')}}" name="name_ar" :requiredSpan="true" colrow="col-lg-4"
                                value="{{old('name_ar',$permission->name_ar)}}" inputclass="dir_ar"/>

            <x-admin.form.input label="{{__('admin/form.text_name')}}" name="name_en" :requiredSpan="true" colrow="col-lg-4"
                                value="{{old('name_en',$permission->name_en)}}" inputclass="dir_en"/>
          </div>
        </div>
        <div class="container-fluid">
          <x-admin.form.submit text="{{$pageData['ViewType']}}"/>
        </div>
      </form>
    </x-admin.card.def>
  </x-admin.hmtl.section>
@endsection





