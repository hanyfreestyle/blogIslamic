@extends('admin.layouts.app')

@section('StyleFile')
    <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
                @include('admin.mainView.post.index_header')
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
                ajax: "{{ route($PrefixRoute.'.DataTable') }}",

                columns: [
                    {data: 'id', name: 'id'},

                        @if($Config['postPhotoView'])
                    {
                        data: 'photo', name: 'photo', orderable: false, searchable: false, className: "text-center"
                    },
                        @endif

                        @if($Config['postPublishedDate'])
                    {
                        'name': 'published_at',
                        'data': {
                            '_': 'published_at.display',
                            'sort': 'published_at.timestamp'
                        }
                    },
                        @endif
                    {
                        data: 'tablename.0.name', name: 'tablename.name'
                    },

                        @if($Config['TableCategory'])
                    {
                        data: 'CatName', name: 'CatName', orderable: false, searchable: false
                    },
                        @endif

                    {
                        data: 'is_active', name: 'is_active', orderable: false, searchable: false, className: "text-center"
                    },

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

