@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    @can($PrefixRole."_edit")
        @if($Config['categorySort'])
            <x-admin.hmtl.section>
                <div class="row mb-3">
                    <div class="col-12 dir_button">
                        <x-admin.form.action-button url="{{route($PrefixRoute.'.CatSort',0)}}" type="sort" :tip="false" bg="dark"/>
                    </div>
                </div>
            </x-admin.hmtl.section>
        @endif
    @endcan

    <x-admin.hmtl.section>
        @if($Config['categoryTree'])
            <ol class="breadcrumb breadcrumb_menutree">
                <li class="breadcrumb-item"><a href="{{route($PrefixRoute.'.index_Main')}}">{{__('admin/def.category_main')}}</a></li>
                @if($pageData['SubView'])
                    @foreach($trees as $tree)
                        <li class="breadcrumb-item"><a href="{{route($PrefixRoute.'.SubCategory',$tree->id)}}">{{ $tree->name }}</a></li>
                    @endforeach
                @endif
            </ol>
        @endif


        <x-admin.card.def :page-data="$pageData">
            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            @if($Config['categoryPhotoView'])
                                <th class="TD_20"></th>
                            @endif
                            <th>{{DefCategoryTextName($Config['LangCategoryDefName'])}}</th>
                            <th class="TD_20"></th>
                            <x-admin.table.action-but po="top" type="addLang"/>
                            <x-admin.table.action-but po="top" type="edit"/>
                            @if($Config['categoryDelete'])
                                <x-admin.table.action-but po="top" type="delete"/>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                @if($Config['categoryPhotoView'])
                                    <td class="tc">{!! TablePhoto($row,'photo') !!} </td>
                                @endif
                                <td>{!! printCategoryName($Config['categoryDefLang'],$row,$PrefixRoute.".SubCategory") !!}</td>
                                <td>{!! is_active($row->is_active) !!}</td>
                                <x-admin.table.action-but type="addLang" :row="$row"/>
                                <x-admin.table.action-but type="edit" :row="$row"/>
                                @if($Config['categoryDelete'])
                                    <x-admin.table.action-but type="delete" :row="$row"/>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata"/>
            @endif
        </x-admin.card.def>
        <x-admin.hmtl.pages-link :row="$rowData"/>

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
@endpush

