@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route('admin.users.roles.update',intval($role->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="view_type" value="{{$pageData['ViewType']}}">
        <div class="col-lg-12">

          <div class="row">
            <x-admin.form.input label="{{__('admin/config/roles.role_frname')}}" name="name" colrow="col-lg-4"
                                value="{{old('name',$role->name)}}" inputclass="dir_en"/>

            <x-admin.form.input name="name_ar" :row="$role" :label="__('admin/config/roles.permission_frname')" col="4" tdir="ar"/>
            <x-admin.form.input name="name_en" :row="$role" :label="__('admin/config/roles.permission_frname')" col="4" tdir="en"/>

         </div>

        </div>

        <x-admin.form.submit-role-back :page-data="$pageData"/>
      </form>
    </x-admin.card.def>
  </x-admin.hmtl.section>
@endsection



