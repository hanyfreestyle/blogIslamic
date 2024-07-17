@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">

      <form action="{{route($PrefixRoute.'.storeUpdate',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <x-admin.form.input label="# CatId" name="cat_id" :requiredSpan="true" colrow="col-lg-3"
                            value="{{old('cat_id',$rowData->cat_id)}}" inputclass="dir_en"/>
        <hr>
        <x-admin.form.upload-file view-type="{{$pageData['ViewType']}}" :row-data="$rowData" fild-name="photo" :multiple="false"/>

        <x-admin.form.submit-role-back :page-data="$pageData"/>
      </form>
    </x-admin.card.def>
  </x-admin.hmtl.section>
@endsection
