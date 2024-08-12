@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-app-plugin.blog.filter-form :row="$rowData" form-name="{{$formName}}" :def-route="$filterRoute"/>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
                <thead>
                <tr>
                    <th class="TD_20">#</th>
{{--                    <th class="TD_20"></th>--}}
                    <th class="TD_80">{{$Config['LangPostPublishedDateName']}}</th>
                    <th class="TD_80">{{__('admin/blogPost.blog_user')}}</th>
                    <th class="TD_250">{{$Config['LangPostDefName']}}</th>
                    <th class="TD_250">Slug</th>
{{--                    <th class="TD_100">{{__('admin/blogPost.cat_text_name')}}</th>--}}
                    <x-admin.table.action-but po="top" type="edit"/>
                    <x-admin.table.action-but po="top" type="delete"/>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </x-admin.card.def>


    </x-admin.hmtl.section>
@endsection

@push('JsCode')
    <x-admin.data-table.sweet-dalete/>
    <x-admin.data-table.plugins :jscode="true" :is-active="$viewDataTable"/>
    <script type="text/javascript">
        $(function () {
            var table = $('.DataTableView').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                order: [0, 'desc'],
                @include('datatable.lang')
                ajax: "{{ route($PrefixRoute.$routeName) }}",

                columns: [
                    {data: 'id', name: 'id'},
                    // {data: 'photo', name: 'photo', orderable: false, searchable: false, className: "text-center"},

                    {
                        'name': 'published_at',
                        'data': {
                            '_': 'published_at.display',
                            'sort': 'published_at.timestamp'
                        }
                    },
                    {data: 'user_name', name: 'users.name' ,orderable: false, searchable: false,},

                    {data: 'name', name: 'blog_translations.name'  },
                    {data: 'slug', name: 'blog_translations.slug'  },

                    {{--{data: 'CatName', name: 'CatName', orderable: false, searchable: false},--}}
                        @can($PrefixRole.'_edit')
                    {
                        data: 'Edit', name: 'Edit', orderable: false, searchable: false, className: "text-center"
                    },
                        @endcan

                        @can($PrefixRole.'_delete')
                    {
                        data: 'Delete', name: 'Delete', orderable: false, searchable: false, className: "text-center"
                    },
                    @endcan
                ],

            });
        });
    </script>
@endpush

