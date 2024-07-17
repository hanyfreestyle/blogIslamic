@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
                        @include('admin.mainView.post.index_header')
                        <tbody>
                        @foreach($rowData as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                @if($Config['postPhotoView'])
                                    <td class="tc">{!! TablePhoto($row,'photo') !!} </td>
                                @endif

                                @if($Config['postPublishedDate'])
                                    <td class="tc">{{$row->getFormatteDate()}}</td>
                                @endif


                                <td>{{$row->name ?? ''}}</td>

                                @if($pageData['ViewType'] == 'deleteList')
                                    <x-admin.table.soft-delete type="b" :row="$row"/>
                                @else

                                    @if($Config['TableCategory'])
                                        <td>
                                            @foreach($row->categories as $Category )
                                                <a href="{{route($PrefixRoute.'.ListCategory',$Category->id)}}">
                                                    <span class="cat_table_name">{{ print_h1($Category)}}</span>
                                                </a>
                                            @endforeach
                                        </td>
                                    @endif

                                    <td>{!! is_active($row->is_active) !!}</td>
                                    <x-admin.table.action-but type="edit" :row="$row"/>
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

