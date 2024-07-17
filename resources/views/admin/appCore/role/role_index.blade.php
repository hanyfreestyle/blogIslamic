@extends('admin.layouts.app')

@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      @if(count($roles)>0)
        <div class="card-body table-responsive p-0">
          <table {!!Table_Style($viewDataTable,$yajraTable) !!}>
            <thead>
            <tr>
              <th class="TD_20">#</th>
              <th>{{__('admin/config/roles.role_frname')}}</th>
              <th>{{__('admin/config/roles.permission_frname')}}</th>
              @can('roles_update_permissions')
                <th class="TD_200"></th>
              @endcan
              <x-admin.table.action-but po="top" type="edit"/>
              <x-admin.table.action-but po="top" type="delete"/>
            </tr>
            </thead>
            <tbody>

            @foreach($roles as $role)
              <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->$rolePrintName}}</td>
                @can('roles_update_permissions')
                  <td class="text-center">
                    <x-admin.form.action-button url="{{route('admin.users.roles.editRoleToPermission',$role->id)}}" icon="fas fa-user-shield"
                                                print-lable="{{__('admin/config/roles.role_edit_permission')}}" bg="p" :tip="false"/>
                  </td>
                @endcan
                <x-admin.table.action-but type="edit" :row="$role"/>
                <x-admin.table.action-but type="delete" :row="$role"/>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @else
        <x-admin.hmtl.alert-massage type="nodata"/>
      @endif
    </x-admin.card.def>
    <x-admin.hmtl.pages-link :row="$roles"/>
  </x-admin.hmtl.section>
@endsection

@push('JsCode')
  <x-admin.table.sweet-delete-js/>
  <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
@endpush
