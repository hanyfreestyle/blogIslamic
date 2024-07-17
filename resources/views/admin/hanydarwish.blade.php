<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Example: Browsing Files</title>
  <script>
      // Helper function to get parameters from the query string.
      function getUrlParam( paramName ) {
          var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );
          var match = window.location.search.match( reParam );

          return ( match && match.length > 1 ) ? match[1] : null;
      }
      // Simulate user action of selecting a file to be returned to CKEditor.
      function returnFileUrl() {

          var funcNum = getUrlParam( 'CKEditorFuncNum' );
          // var fileUrl = '/path/to/file.txt';
          var fileUrl = 'https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png';
          window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
          window.close();
      }
  </script>
</head>
<body>
<button onclick="returnFileUrl()">Select File</button>
</body>
</html>

{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--<meta charset="UTF-8">--}}
{{--<title>Example: Browsing Files</title>--}}






{{--  <script>--}}
{{--      // Helper function to get parameters from the query string.--}}
{{--      function getUrlParam( paramName ) {--}}
{{--          var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' );--}}
{{--          var match = window.location.search.match( reParam );--}}

{{--          return ( match && match.length > 1 ) ? match[1] : null;--}}
{{--      }--}}
{{--      // Simulate user action of selecting a file to be returned to CKEditor.--}}
{{--      function returnFileUrl(fileUrl) {--}}

{{--          var funcNum = getUrlParam( 'CKEditorFuncNum' );--}}
{{--          // var fileUrl = 'http://c.cksource.com/a/1/img/sample.jpg';--}}
{{--          window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl, function() {--}}
{{--              // Get the reference to a dialog window.--}}
{{--              var dialog = this.getDialog();--}}
{{--              // Check if this is the Image Properties dialog window.--}}
{{--              if ( dialog.getName() == 'image' ) {--}}
{{--                  // Get the reference to a text field that stores the "alt" attribute.--}}
{{--                  var element = dialog.getContentElement( 'info', 'txtAlt' );--}}
{{--                  // Assign the new value.--}}
{{--                  if ( element )--}}
{{--                      element.setValue( 'alt text' );--}}
{{--              }--}}
{{--              // Return "false" to stop further execution. In such case CKEditor will ignore the second argument ("fileUrl")--}}
{{--              // and the "onSelect" function assigned to the button that called the file manager (if defined).--}}
{{--              // return false;--}}
{{--          } );--}}
{{--          window.close();--}}
{{--      }--}}
{{--  </script>--}}
{{--</head>--}}
{{--<body>--}}
{{--@foreach($photos as $photo)--}}

{{--  <img src="{{url($photo)}}">--}}
{{--  <button onclick="returnFileUrl('{{url($photo)}}')">Select File</button>--}}
{{--  {{echobr(url($photo))}}--}}

{{--@endforeach--}}


{{--</body>--}}
{{--</html>--}}


<ul role="tree" aria-labelledby="tree_label">
  <li role="treeitem" aria-expanded="false" aria-selected="false">
    <span> Projects </span>
    <ul role="group">

      <li role="treeitem" aria-expanded="false" aria-selected="false">
        <span accessKeyLabel="hany"> Project 3 </span>
        <ul role="group">
          <li role="treeitem" aria-selected="false" class="doc">project-3A.docx</li>
          <li role="treeitem" aria-selected="false" class="doc">project-3B.docx</li>
          <li role="treeitem" aria-selected="false" class="doc">project-3C.docx</li>
        </ul>
      </li>

      <li role="treeitem" aria-expanded="false" aria-selected="false">
        <span> Project 5 </span>
        <ul role="group">
          <li role="treeitem" aria-selected="false" class="doc">project-5A.docx</li>
          <li role="treeitem" aria-selected="false" class="doc">project-5B.docx</li>
          <li role="treeitem" aria-selected="false" class="doc">project-5C.docx</li>
          <li role="treeitem" aria-selected="false" class="doc">project-5D.docx</li>
          <li role="treeitem" aria-selected="false" class="doc">project-5E.docx</li>
          <li role="treeitem" aria-selected="false" class="doc">project-5F.docx</li>
        </ul>
      </li>
    </ul>
  </li>

</ul>
