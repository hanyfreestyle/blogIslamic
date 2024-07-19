@extends('admin.layouts.app')
@section('StyleFile')
  {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin-plugins/')->MinifyCss('file-manager/style.css','Seo',true) !!}
  <style>

  </style>
@endsection
@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  @include('AppPlugin.FileManager.fileManager_menu')

  <x-admin.card.normal :title="__('admin/fileManager.menu_add')">
    <div class="row">
      <div class="col-lg-12">
        <form class="mainForm" action="{{route($PrefixRoute.'.UploadPhotos')}}" method="post" enctype="multipart/form-data">
          @csrf

          <div class="row">
            @if($errors->has([]))
              <div class="col-lg-12 alert alert-danger alert-dismissible">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </div>
            @endif


          </div>

          <div class="row mb-2">
            <div class="col-lg-7">
              <div class="form-group">

                <label class="def_form_label col-form-label font-weight-light">{{__('admin/fileManager.form_sel_folder')}}</label>

                <select class="form-control select2s is-invalidX" id="path" name="path" style="direction: ltr!important;  text-align: left">
                  <option value="">{{__('admin/fileManager.form_sel_folder_root')}}</option>
                  @foreach ($directories as  $category)
                    <option value="{{ $category['path'] }}"
                            @if ($category['path'] == old('path',issetArr($_GET,'path',null))) selected @endif>{{ $category['name'] }}</option>
                    @if (count($category['children']) > 0 )
                      @include('AppPlugin.FileManager.subcategories', ['subcategories' => $category['children'], 'parent' => $category['name'] ])
                    @endif
                  @endforeach
                </select>

              </div>
            </div>
            <div class="col-lg-5">
              <x-admin.form.input name="new_folder" :label="__('admin/fileManager.form_add_folder')" value="{{old('new_folder')}}" tdir="en"
                                  :req="false"/>
            </div>

          </div>
          <div class="row">

            <div class="col-lg-8">


              <x-admin.form.select-arr label="{{__('admin/config/upFilter.form_select_filter_lable')}}" name="filter_id" colrow="col-lg-6"
                                       :sendvalue="old('filter_id',issetArr($_GET,'filter',null))" :send-arr="$filterTypes"/>
            </div>

            <div class="col-lg-8">
              <div class="col-md-12 mt-3">
                <input class="form-control @error('image') is-invalid @enderror" type="file" name="image[]" multiple>
              </div>

              {{--              <x-admin.form.upload-file view-type="Add" :multiple="true" :thisfilterid="old('filter_id',isset($_GET['filter_id']))"/>--}}
            </div>
          </div>
          <div class="container-fluid mb-3 mt-3">
            <x-admin.form.submit text="Add"/>
          </div>
        </form>
      </div>
    </div>


  </x-admin.card.normal>



@endsection


@push('JsCode')

@endpush




