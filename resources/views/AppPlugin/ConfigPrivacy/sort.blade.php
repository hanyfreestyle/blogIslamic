@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row mb-3">
            <div class="col-12 text-left">
                <x-admin.form.action-button  url="{{route($PrefixRoute.'.index')}}"  type="back" :tip="false"/>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <div class="row mt-3 mb-5">
            @if(count($WebPrivacy)>0)
                <div class="row col-lg-12 hanySort">
                    @foreach($WebPrivacy as $row)
                        <div class="col-lg-12"  data-index="{{$row->id}}" data-position="{{$row->postion}}" >
                            <p class="ListItem-12">{{$row->id}} {{$row->h1}}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-lg-12">
                    <x-admin.hmtl.alert-massage type="nodata" />
                </div>
            @endif
        </div>
    </x-admin.hmtl.section>

@endsection


@push('JsCode')
    <script src="{{defAdminAssets('plugins/bootstrap/js/jquery-ui.min.js')}}"></script>
    <x-admin.ajax.sort-code url="{{ route($PrefixRoute.'.SaveSort') }}" />
@endpush


