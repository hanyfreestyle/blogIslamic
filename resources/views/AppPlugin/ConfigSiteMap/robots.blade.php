@extends('admin.layouts.app')
@section('StyleFile')
    <style>
        #robots {
            direction: ltr;
            min-height: 450px;
            font-size: 13px;
        }
    </style>
@endsection
@section('content')

    <x-admin.hmtl.breadcrumb :page-data="$pageData"/>
    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12 siteMapBut">
                <x-admin.form.action-button :url="route($PrefixRoute.'.index')" :tip="false" print-lable="Update Site Map" size="m" icon="fas fa-sitemap" bg="p"/>
                <x-admin.form.action-button :url="route($PrefixRoute.'.GoogleCode')" :tip="false" print-lable="Update Google Code" size="m" icon="fas fa-code" bg="d"/>
            </div>
        </div>
    </x-admin.hmtl.section>


    <x-admin.hmtl.section>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{route($PrefixRoute.".RobotsUpdate")}}" method="post">
                    @csrf
                    <div class="row mt-3 siteMapRobots">
                        <x-admin.card.normal bg title="Update Robots">
                            <div class="row mb-5">
                                <x-admin.form.textarea :row="$googleCode" name="robots" :value="old('robots',$googleCode->robots)" id="robots" label="" col="12" dir="en" :req="false"/>
                            </div>
                        </x-admin.card.normal>
                    </div>
                    <button type="submit" class="btn float-left btn-primary">{{__('admin/configSitemap.f_but_update')}}</button>
                </form>
            </div>
        </div>
    </x-admin.hmtl.section>
@endsection

