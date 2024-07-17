@extends('admin.layouts.app')
@section('StyleFile')
    <x-admin.data-table.plugins  :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" >
            @if(count($permissions)>0)
                <div class="card-body table-responsive p-0">
                    <table  {!!Table_Style($viewDataTable,$yajraTable) !!}>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('admin/config/roles.permission_frname')}}</th>
{{--                            <th>{{__('admin/config/roles.model_name')}}</th>--}}
                            <th>{{__('admin/form.text_name')}}</th>
                            <th>{{__('admin/form.text_name')}}</th>
                            <x-admin.table.action-but po="top" type="edit"/>
                            <x-admin.table.action-but po="top" type="delete"/>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($permissions as $permission)
                            <tr>
                                <td >{{$permission->id}}</td>
                                <td>{{$permission->name}}</td>
{{--                                <td >{{ $modelsNameArr[$permission->cat_id]['name'] }}</td>--}}
                                <td>{{$permission->name_ar}}</td>
                                <td>{{$permission->name_en}}</td>
                                <x-admin.table.action-but type="edit" :row="$permission" />
                                <x-admin.table.action-but type="delete" :row="$permission" />
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <x-admin.hmtl.alert-massage type="nodata" />
            @endif
        </x-admin.card.def>
        <x-admin.hmtl.pages-link :row="$permissions" />


    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins  :jscode="true" :is-active="$viewDataTable" />
@endpush
