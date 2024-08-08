@extends('admin.layouts.app')

@section('content')

    <x-admin.hmtl.breadcrumb :page-data="$pageData"/>
    <x-admin.hmtl.section>

            <div class="row">
                <div class="col-lg-12 siteMapBut">
                    <x-admin.form.action-button :url="route($PrefixRoute.'.index')" :tip="false" print-lable="Update Site Map" size="m" icon="fas fa-sitemap" bg="p"/>
                    <x-admin.form.action-button :url="route($PrefixRoute.'.Robots')" :tip="false" print-lable="Update Robots" size="m" icon="fas fa-robot" bg="i"/>
                </div>
            </div>

    </x-admin.hmtl.section>


    <x-admin.hmtl.section>

        <div class="row">
            <div class="col-lg-12">
                <form class="mainForm" action="{{route($PrefixRoute.".GoogleCodeUpdate")}}" method="post">
                    @csrf
                    <div class="row mt-3">
                        <x-admin.card.normal bg title="Update Google Codes">
                            <div class="row mb-5">
                                <x-admin.form.input :row="$googleCode" name="tag_manager_code" label="Tag Manager Code" col="6" tdir="en" :req="false"/>
                                <x-admin.form.input :row="$googleCode" name="analytics_code" label="Google Analytics Code " col="6" tdir="en" :req="false"/>
                                <x-admin.form.input :row="$googleCode" name="web_master_html" label="Web Master Html " col="6" tdir="en" :req="false"/>
                                <x-admin.form.input :row="$googleCode" name="web_master_meta" label="Web Master Meta" col="6" tdir="en" :req="false"/>
                                <x-admin.form.input :row="$googleCode" name="google_api" label="Google API" col="6" tdir="en" :req="false"/>
                            </div>
                        </x-admin.card.normal>
                    </div>
                    <button type="submit" class="btn float-left btn-primary">{{__('admin/configSitemap.f_but_update')}}</button>
                </form>
            </div>
        </div>
    </x-admin.hmtl.section>
@endsection

