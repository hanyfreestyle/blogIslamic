@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($oldData->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <x-admin.form.input :row="$oldData" label="# CatId" name="cat_id" col="4" tdir="en"/>
        </div>
        <x-admin.main.meta-tage :old-data="$oldData" :placeholder="false"/>
        <hr>

        @if(config('AppPlugin.Meta.name'))
          <div class="row">
            @foreach ( config('app.web_lang') as $key=>$lang )
              <div class="col-lg-{{getColLang(6)}}">
                <x-admin.form.trans-input :row="$oldData" name="name" :key="$key" :tdir="$key" :req="false"
                                          :label="__('admin/form.text_name')"/>
                <x-admin.form.trans-text-area :row="$oldData" name="des" :key="$key" :tdir="$key" :req="false"
                                              :label="__('admin/form.text_content')"/>
              </div>
            @endforeach
          </div>
          <hr>
        @endif


        <x-admin.form.upload-file view-type="{{$pageData['ViewType']}}" :row-data="$oldData" row-col="col-lg-6"
                                  :multiple="false"
                                  thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,$controllerName.'_filterid',0) }}"
                                  :emptyphotourl="$PrefixRoute.'.emptyPhoto'"/>
        <hr>
        <x-admin.form.submit-role-back :page-data="$pageData"/>
      </form>
    </x-admin.card.def>
  </x-admin.hmtl.section>
@endsection
