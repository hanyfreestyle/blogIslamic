@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            @if(count($users)>0)
                <div class="card-body table-responsive p-0">
                    <table {!!Table_Style($viewDataTable,$yajraTable) !!} >
                        <thead>
                        <tr>
                            <th class="TD_20">#</th>
                            <th class="TD_20"></th>
                            <th class="TD_200">{{__('admin/config/roles.users_fr_name')}}</th>
                            <th class="TD_200">{{__('admin/config/roles.users_fr_email')}}</th>
                            @if($pageData['ViewType'] == 'deleteList')
                                <x-admin.table.soft-delete/>
                            @else
                                <th class="TD_150">{{ __('admin/config/roles.users_fr_status') }}</th>
                                <th class="TD_300">{{ __('admin/config/roles.users_fr_role') }}</th>

                                @if(File::isFile(base_path('routes/AppPlugin/blogPost.php')))
                                    <th class="TD_100">{{ __('admin/config/roles.t_post_count') }}</th>
                                @endif

                                <x-admin.table.action-but po="top" type="edit"/>
                                <x-admin.table.action-but po="top" type="delete"/>
                            @endif
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{!! TablePhoto($user,'photo') !!} </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if($pageData['ViewType'] == 'deleteList')
                                    <x-admin.table.soft-delete type="b" :row="$user"/>
                                @else
                                    @can($PrefixRole."_edit")
                                        <td><input type="checkbox" class="status_but" thisid="{{$user->id}}" name="status" @if($user->status == '1') checked
                                                   @endif data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>
                                    @else
                                        <td class="text-center">{!! is_active($user->status) !!}</td>
                                    @endcan
                                    <td>
                                        @foreach($roles as $role)
                                            @if($user->hasRole($role->name))
                                                <x-admin.form.action-button print-lable="{{$role->$PrintLocaleName}}" :tip="false"/>
                                            @endif
                                        @endforeach
                                    </td>
                                    @if(File::isFile(base_path('routes/AppPlugin/blogPost.php')))
                                        <td class="text-center">{{count($user->del_post)}}</td>
                                    @endif
                                    <x-admin.table.action-but type="edit" :row="$user"/>
                                    <x-admin.table.action-but type="delete" :row="$user"/>
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
        <x-admin.hmtl.pages-link :row="$users"/>
    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
    <script>
        $(".status_but").bootstrapSwitch({
            'size': 'mini',
            'onSwitchChange': function (event, state) {
                var inputId = $(this).attr('thisid');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{ route($PrefixRoute.'.updateStatus') }}',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        send_id: inputId,
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            },
        });
    </script>
@endpush
