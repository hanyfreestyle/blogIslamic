@extends('admin.layouts.app')

@section('StyleFile')
  <x-admin.data-table.plugins :style="true" :is-active="$viewDataTable"/>
@endsection

@section('content')
  <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

  <x-admin.hmtl.section>
    <x-admin.card.def :page-data="$pageData">
      <table {!! Table_Style($viewDataTable,$yajraTable)  !!} >
        @include('AppPlugin.Pages.index_header')
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
                  {data: 'photo', name: 'photo', orderable: false, searchable: false},
                  {data: 'tablename.0.name', name: 'tablename.name'},
                  @if(count(config('app.web_lang')) > 1)
                  {data: 'tablename.1.name', name: 'tablename.name'},
                  @endif

                  {data: 'CatName', name: 'CatName', orderable: false, searchable: false},
                  {data: 'is_active', name: 'is_active', orderable: false, searchable: false},

                  @can($PrefixRole.'_edit')
                  @if(count(config('app.web_lang')) > 1)
                  {data: 'AddLang', name: 'AddLang', orderable: false, searchable: false},
                  @endif

                  {data: 'MorePhoto', name: 'MorePhoto', orderable: false, searchable: false},
                  {data: 'Edit', name: 'Edit', orderable: false, searchable: false},
                  @endcan

                  @can($PrefixRole.'_delete')
                  {
                      data: 'Delete', name: 'Delete', orderable: false, searchable: false
                  },
                @endcan
              ]
          });
      });
  </script>
@endpush

