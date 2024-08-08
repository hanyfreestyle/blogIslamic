@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :page-data="$pageData"/>
    <x-admin.hmtl.section>
        @if(count($rowData)>0)
            <div class="row">
                <div class="col-lg-12 siteMapBut">
                    <x-admin.form.action-button :url="route($PrefixRoute.'.Robots')" :tip="false" print-lable="Update Robots" size="m" icon="fas fa-robot" bg="i"  />
                    <x-admin.form.action-button :url="route($PrefixRoute.'.GoogleCode')" :tip="false" print-lable="Update Google Code" size="m" icon="fas fa-code"  bg="d" />
                </div>
            </div>
        @endif
        <div class="row mt-3">
            <x-admin.card.normal title="Update Site Maps">

                @if(count($rowData)>0)

                    <div class="card-body table-responsive p-0">
                        <table {!! Table_Style(false,false)  !!} >
                            <thead>
                            <tr>
                                <th class="TD_20">#</th>
                                <th class="TD_250">{{__('admin/siteMap.t_name')}}</th>
                                <th class="TD_100">{{__('admin/siteMap.t_url_count')}}</th>
                                <th class="TD_100">{{__('admin/siteMap.t_date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rowData as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{ __('admin/siteMap.model_'.$row->cat_id) }}</td>
                                    <td>{{$row->url_count}}</td>
                                    <td>{{$row->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="col-lg-12">
                        <x-admin.hmtl.alert-massage type="nodata" />
                    </div>
                @endif

            </x-admin.card.normal>
        </div>
    </x-admin.hmtl.section>

    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{route($PrefixRoute.".Update")}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-block btn-primary">{{__('admin/configSitemap.f_but_update')}}</button>
                </form>
            </div>
        </div>
    </x-admin.hmtl.section>
@endsection

