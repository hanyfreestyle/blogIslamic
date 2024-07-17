@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" title="{{$role->name_ar}}" >
            <div class="row">
                @foreach($permissionsGroup  as $groupIndex => $permissions)
                    <div class="col-lg-12 mb-3">
                        <div class="row col-lg-12 permission_row">
                            <div class="alert alert-dark alert-dismissible">
                                {{$modelsNameArr[$groupIndex]['name'] ?? '' }}
                            </div>

                            @foreach($permissions as $permission)
                                @if( !$role->hasPermissionTo($permission) )
                                    <div class="col-lg-2">
                                        <label class="font-weight-light">{{$permission->name_ar}}</label>
                                        <div class="form-group">
                                            <input type="checkbox" class="status_but"
                                                   role_id="{{$role->id}}" permissionName="{{$permission->name}}" name="status"
                                                   data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-2">
                                        <label for="">{{$permission->name_ar}}</label>
                                        <div class="form-group">
                                            <input type="checkbox" checked class="status_but"
                                                   role_id="{{$role->id}}" permissionName="{{$permission->name}}" name="status"
                                                   data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <script>
        $(".status_but").bootstrapSwitch({
            'size': 'mini',
            'onSwitchChange': function(event, state){
                var role_id = $(this).attr('role_id');
                var permissionName = $(this).attr('permissionName');
                //alert(inputId);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{ route($PrefixRoute.'.givePermission') }}',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        role_id: role_id,
                        permissionName: permissionName,
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            },
        });
    </script>
@endpush



