@extends('admin.layouts.app')
@section('StyleFile')
  {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin-plugins/')->MinifyCss('file-manager/style.css','Seo',true) !!}
@endsection
@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  @include('AppPlugin.FileManager.fileManager_menu')

  <x-admin.card.normal :title="__('admin/fileManager.menu_folder')">
    <div id="photoListItam"></div>
    <div class="row col-lg-12 py-4">
      <div class="col-lg-12">
        <ul role="treeFoder" aria-labelledby="tree_label">
          @include('AppPlugin.FileManager.browser_tree_folder_admin',['directories' => $directories,'db_directories'=>$db_directories])
        </ul>
      </div>
    </div>
  </x-admin.card.normal>



@endsection


@push('JsCode')
  <script>
      $('.updatefolder').click(function () {
          var path = $(this).attr('id');
          var thisContext = this;
          $.ajax({
              url: '{{route($PrefixRoute.'.updateFolder')}}',
              data: {"path": path},
              success: function (data) {
                  $(thisContext).html(data.icon);
                  $(thisContext).removeClass(data.remove).addClass(data.add);
                  console.log(data);
              }
          });
      });
  </script>
@endpush




