<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Browsing Files</title>
  <link rel="stylesheet" href="{{ defAdminAssets('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ defAdminPluginsAssets('file-manager/bootstrap.min.css') }}">
  {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin-plugins/')->MinifyCss('file-manager/style_folder_tree.css','Seo',true) !!}
  {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin-plugins/')->MinifyCss('file-manager/style.css','Seo',true) !!}
</head>
<body>
<div class="container-fluid_xx container_padding back">
  <div class="row mm_h">
    <div class="col-lg-3">
      <ul role="tree" aria-labelledby="tree_label">
        @include('AppPlugin.FileManager.browser_tree_folder',['directories' => $directories])
      </ul>
      <label><input id="last_action" type="hidden" size="15" readonly=""></label>
    </div>
    <div class="col-lg-9 ">
      <div id="photoListItam">
        <div class="row text-center text-lg-start">
          <x-admin.file-manager.photo-col-row :photo-url="$photoUrl" :db-photos="$db_photos"/>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{defAdminAssets('plugins/jquery/jquery.min.js')}}"></script>
<x-admin.file-manager.folder-tree/>
<script>
    // Helper function to get parameters from the query string.
    function getUrlParam(paramName) {
        var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
        var match = window.location.search.match(reParam);

        return (match && match.length > 1) ? match[1] : null;
    }

    // Simulate user action of selecting a file to be returned to CKEditor.
    function returnFileUrl(fileUrl) {

        var funcNum = getUrlParam('CKEditorFuncNum');
        window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
        window.close();
    }
</script>
</body>
</html>
