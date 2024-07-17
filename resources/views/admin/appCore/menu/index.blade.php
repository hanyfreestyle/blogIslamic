@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <div class="row adminMenuTitle">
            <div class="col-lg-9">
                @if($pageData['ViewType'] == 'Sub')
                   <h1 class="def_h1">{{__($mainMenu->name)}}</h1>
                @endif
            </div>
            <div class="col-lg-3 dir_button">
                <x-admin.form.action-button  url="{{route($PrefixRoute.'.index')}}"  type="back" :tip="false"/>
            </div>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>

        <div class="row adminMenuList">


            @if(count($rowData)>0)
                <div class="row col-lg-12 hanySort">
                    @foreach($rowData as $row)
                        <div class="col-lg-12" data-index="{{$row->id}}" data-position="{{$row->postion}}">
                            <p class="ListItem-12">
                                <i class="{{$row->icon}}"></i>
                                {{__($row->name)}}
                                @if(count($row->subMenu))
                                    <a href="{{route('admin.AdminMenu.sub',$row->id)}}">({{count($row->subMenu)}})</a>
                                @endif
                                <span class="statusBut">
                                    <x-admin.ajax.update-status-but :row="$row"/>
                                </span>
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-lg-12">
                    <x-admin.hmtl.alert-massage type="nodata"/>
                </div>
            @endif
        </div>


    </x-admin.hmtl.section>

@endsection


@push('JsCode')
    <script src="{{defAdminAssets('plugins/bootstrap/js/jquery-ui.min.js')}}"></script>
    <x-admin.ajax.update-status-but-code url="{{ route($PrefixRoute.'.updateStatus') }}"/>
    <x-admin.ajax.sort-code url="{{ route($PrefixRoute.'.SaveSort') }}"/>
@endpush

