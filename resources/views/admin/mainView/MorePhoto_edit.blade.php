@extends('admin.layouts.app')

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>


  <x-admin.hmtl.section>
    <div class="row mb-3">
      <div class="col-lg-7">
        <h1 class="def_h1">{{ print_h1($rowData->modelName)}}</h1>
      </div>
      <div class="col-lg-5 dir_button">
        <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos', $rowData->modelName->id )}}" type="sort" :tip="false"/>
        <x-admin.form.action-button  url="{{route($PrefixRoute.'.More_PhotosEditAll', $rowData->modelName->id )}}" :print-lable="__('admin/form.more_photo_edit')" :tip="false" />
        <x-admin.form.action-button url="{{route($PrefixRoute.'.edit', $rowData->modelName->id)}}" type="back"/>
      </div>
    </div>
  </x-admin.hmtl.section>


  <x-admin.hmtl.section>
    <div class="row">
      <x-admin.card.normal :title="__('admin/form.more_photo_edit')">
        <x-admin.hmtl.confirm-massage/>
        <form action="{{route($PrefixRoute.'.More_PhotosUpdate',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            @foreach ( config('app.web_lang') as $key=>$lang )
              <x-admin.form.trans-text-area name="des" :key="$key" :row="$rowData"
                                            :label="__('admin/form.text_content')" :tdir="$key" add-class="bigTextArea" col="{{getColLang(6,12)}}"/>
            @endforeach
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-6">
              <input type="hidden" name="model_id" value="{{intval($rowData->modelName->id)}}">
              <input type="hidden" name="name" value="{{ print_h1($rowData->modelName)}}">
              <x-admin.form.upload-file view-type="Edit" :row-data="$rowData"
                                        thisfilterid="{{ \App\Helpers\AdminHelper::arrIsset($modelSettings,$controllerName.'_morephoto_filterid',0) }}"
              />
            </div>
          </div>
          <div class="container-fluid mb-5">
            <x-admin.form.submit text="Edit"/>
          </div>
        </form>

      </x-admin.card.normal>
    </div>
  </x-admin.hmtl.section>


@endsection

@push('JsCode')
  @if($viewEditor)
    <x-admin.form.ckeditor-jave height="350"/>
  @endif
@endpush
