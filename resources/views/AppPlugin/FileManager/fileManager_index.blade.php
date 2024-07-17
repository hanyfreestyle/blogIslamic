@extends('admin.layouts.app')
@section('StyleFile')
  {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin-plugins/')->MinifyCss('file-manager/style_folder_tree.css','Seo',true) !!}
  {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin-plugins/')->MinifyCss('file-manager/style.css','Seo',true) !!}
@endsection
@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  @include('AppPlugin.FileManager.fileManager_menu')
  <x-admin.card.normal :title="$cardTitle">
    <div class="row col-lg-12 py-4">
      <div class="col-lg-9 order-1" style="float: left!important;">
        <div id="photoListItam">
          <div class="row text-center text-lg-start">
            <x-admin.file-manager.photo-col-row :photo-url="$photoUrl" :db-photos="$db_photos" :view-type="$viewType"/>
          </div>
        </div>
      </div>
      <div class="col-lg-3 order-2" style="float: left!important;">
        <ul role="tree" aria-labelledby="tree_label">
          @include('AppPlugin.FileManager.browser_tree_folder',['directories' => $directories, 'db_directories'=> $db_directories])
        </ul>
        <input id="last_action" type="hidden" size="15" readonly="">

      </div>
    </div>
  </x-admin.card.normal>
@endsection


@push('JsCode')
  <x-admin.file-manager.folder-tree list-route="admin.fileManager.listphoto" :view-type="$viewType"/>
  <script>
      $('.removeOrUpdatePhoto').click(function () {
          var path = $(this).attr('id');
          var thisContext = this;
          // alert(thisContext);
          $.ajax({
              url: '{{route('admin.fileManager.updatePhoto')}}',
              data: {"path": path},
              success: function (data) {
                  $(thisContext).closest(".parent_div").fadeOut(300);
                  // console.log(data);
              }
          });
      });
  </script>
@endpush




