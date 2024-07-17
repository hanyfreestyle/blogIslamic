<x-admin.hmtl.section>
    @if($newRoute)
        <form class="mainForm_New" action="{{$newRoute}}" method="post" enctype="multipart/form-data">
            @else
                <form class="mainForm_New" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
                    @endif

                    @if(isset($pageData['BoxH1']))
                        <div class="form_title">{{$pageData['BoxH1']}}</div>
                    @endif
                    @if($printErr)
                        @if($errors->has([]))
                            <div class="alert alert-danger alert-dismissible">
                                {{__('admin/alertMass.form_has_error')}}
                                @if($fullErr)
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                        <x-admin.hmtl.confirm-massage/>
                    @endif


                    @csrf
                    <input type="hidden" name="page_type" value="{{$pageData['ViewType']}}">

                    {{$slot}}
                </form>
</x-admin.hmtl.section>
