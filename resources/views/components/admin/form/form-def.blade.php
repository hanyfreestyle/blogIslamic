<x-admin.hmtl.section>
    <form class="mainForm_NewBox" action="{{$formRoute}}" method="post" enctype="multipart/form-data">
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
