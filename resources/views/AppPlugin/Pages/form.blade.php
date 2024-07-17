@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

  <x-admin.hmtl.top-edit-page :page-data="$pageData" :row="$rowData"  />

  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <x-admin.form.select-multiple name="categories" :categories="$Categories" :sel-cat="$selCat"  />
        </div>

        <div class="row">
          <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
          @foreach ( $LangAdd as $key=>$lang )
            <x-admin.lang.meta-tage-filde :row="$rowData" :key="$key" :viewtype="$pageData['ViewType']" :label-view="$viewLabel"
                                          :def-name="__('admin/pages.page_text_name')" />
          @endforeach
        </div>

        <hr>
        <x-admin.form.check-active name="is_active" :row="$rowData" :page-view="$pageData['ViewType']"/>

        <hr>
        <div class="row">
          <x-admin.form.input name="youtube" :row="$rowData" :label="__('admin/form.text_youtube')" col="4" tdir="en" :req="false"  />
          @foreach ( $LangAdd as $key=>$lang )
            <x-admin.form.trans-input name="youtube_title" :key="$key" :row="$rowData" :label="__('admin/form.text_youtube_title')" col="4" :req="false" :tdir="$key"/>
          @endforeach
        </div>


        <hr>
        <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="6"/>

        <x-admin.form.submit-role-back :page-data="$pageData"/>
      </form>

    </x-admin.card.def>
  </x-admin.hmtl.section>


@endsection


@push('JsCode')
  <x-admin.table.sweet-delete-js/>
  <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
  @if($viewEditor)
    <script src="https://cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>
    @foreach ( config('app.web_lang') as $key=>$lang )
      <x-admin.java.ckeditor-by-name name="{{$key}}[des]" :dir="$key" :upload-photo="true"/>
    @endforeach
  @endif


@endpush
