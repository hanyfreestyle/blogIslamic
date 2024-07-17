@can($PrefixRole.'_delete')

    @if($po == 'top')
        <form action="{{route($PrefixRoute.'.DeleteAll')}}" method="post" name="myform" >
            @csrf
            @else
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" name="B1" class="btn  btn-danger {{$dir}}">{{__('admin/form.button_delete_all')}}</button>
                    </div>
                </div>
        </form>
        @push('JsCode')
            <script>
                function check_all_in_document(doc) {
                    var c = new Array();
                    c = doc.getElementsByTagName('input');
                    for (var i = 0; i < c.length; i++)
                    {
                        if (c[i].type == 'checkbox')
                        {
                            c[i].checked = true;
                        }
                    }
                }

                function check_no_in_document(doc) {
                    var c = new Array();
                    c = doc.getElementsByTagName('input');
                    for (var i = 0; i < c.length; i++)
                    {
                        if (c[i].type == 'checkbox')
                        {
                            c[i].checked = false;
                        }
                    }
                }

                function Check(chk) {
                    if(document.myform.Check_ctr.checked==true){
                        check_all_in_document(myform);
                    }else{
                        check_no_in_document(myform);
                    }
                }
            </script>
        @endpush
    @endif
@endcan
