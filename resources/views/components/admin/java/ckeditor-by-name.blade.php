<script>
    CKEDITOR.replace('{{$name}}',
     {
         language: 'en',
         @if($dir == 'ar')
         contentsLangDirection: 'rtl',
         @endif
         height: {{$height}},
         @if($uploadPhoto)
         filebrowserUploadUrl: "{{route($PrefixRoute.'.CkeditorUpload',['_token'=>csrf_token()])}}",
         @endif
         removePlugins : 'print,save,newpage,flash,another',
         toolbarGroups : [
             { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
             { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
             // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
             { name: 'insert', groups: [ 'insert' ] },
             { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
             { name: 'links', groups: [ 'links' ] },
             { name: 'colors', groups: [ 'colors' ] },
             { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
             { name: 'styles', groups: [ 'styles' ] },
             { name: 'tools', groups: [ 'tools' ] },
         ],

     });
    CKEDITOR.config.removeButtons = 'Save,NewPage,ExportPdf,Preview,Print,Templates,About,Smiley,SpecialChar,PageBreak,Iframe,Language,BidiRtl,BidiLtr,Subscript,Superscript,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Find,Replace,SelectAll,Scayt';
</script>