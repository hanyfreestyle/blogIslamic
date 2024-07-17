@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" >
            @if(count($rowData)>0)
                <div class="card-body table-responsive p-0">
                    <table {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th>{{__('admin/config/upFilter.form_name')}}</th>
                            <th>{{__('admin/config/upFilter.form_type')}}</th>
                            <th class="tdc">{{__('admin/config/upFilter.form_new_w')}}</th>
                            <th class="tdc">{{__('admin/config/upFilter.form_new_h')}}</th>
                            @if($pageData['ViewType'] == 'deleteList')
                                <x-admin.table.soft-delete />
                            @else
                                <th class="tdc">WEBP</th>
                                <th class="tdc">{{__('admin/config/upFilter.table_watermark')}}</th>
                                <th class="tdc">{{__('admin/config/upFilter.table_text')}}</th>
                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="delete"/>
                            @endif
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($rowData as $row)
                            <tr>
                                <td >{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{ $filterTypeArr[$row->type]['name'] }}</td>
                                <td class="tdc">{{$row->new_w}}</td>
                                <td class="tdc">{{$row->new_h}}</td>
                                @if($pageData['ViewType'] == 'deleteList')
                                    <x-admin.table.soft-delete type="b" :row="$row" />
                                @else
                                    <td class="tdc">{!! is_active($row->convert_state) !!}</td>
                                    <td class="tdc">{!! is_active($row->watermark_state) !!}</td>
                                    <td class="tdc">{!! is_active($row->text_state) !!}</td>
                                    <x-admin.table.action-but type="edit" :row="$row" />
                                    <x-admin.table.action-but type="delete" :row="$row" />
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata" />
            @endif
        </x-admin.card.def>
        <x-admin.hmtl.pages-link :row="$rowData" />

    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="$viewDataTable" />
@endpush
