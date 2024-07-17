@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <div class="content mb-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-9">
            <h1 class="def_h1_new">{{$rowData->name}}</h1>
          </div>
        </div>
      </div>
    </div>
  </x-admin.hmtl.section>

  <x-admin.hmtl.section>
    <div class="row">
      <form class="mainForm uploadFilterForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post">
        @csrf
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <x-admin.photofilter.main-setting :row="$rowData" :row-data-size="$rowDataSize"/>
              <x-admin.photofilter.watermark :row="$rowData"/>
            </div>
            <div class="col-lg-6">
              <x-admin.photofilter.more-setting :row="$rowData"/>
              <x-admin.photofilter.text-setting :row="$rowData"/>

              <x-admin.card.normal title="{{__('admin/config/upFilter.notes_card')}}">
                <div class="row">
                  @foreach(config('app.web_lang') as $key=>$lang)
                    @php
                      $PrintName = "notes_".$key
                    @endphp
                    <x-admin.form.input :row="$rowData" name="notes_{{$key}}" col="12" tdir="{{$key}}"
                                        label="{{__('admin/config/upFilter.notes_input')}} ({{$key}})"/>
                  @endforeach
                </div>
              </x-admin.card.normal>
            </div>
          </div>
        </div>
        <div class="row mb-5">
          <x-admin.form.submit-role-back :page-data="$pageData"/>
        </div>
      </form>
    </div>
  </x-admin.hmtl.section>

@endsection


@push('JsCode')
  <x-admin.table.sweet-delete-js/>
  <script>
      $(document).ready(function () {
          $("#watermark_img").change(function () {
              var getImagePath = $(this).val();
              var appPath = $("#app_path").val();
              var currentImage = appPath + getImagePath;
              $("#imageused").attr("src", currentImage);
          });
      });
  </script>
@endpush
