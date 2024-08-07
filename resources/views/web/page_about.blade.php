@extends('web.layouts.app')
@section('content')
    <x-admin.hmtl.test-meta/>
    <div class="area_padding">
        <div class="container">
            <div class="col-lg-12">
                {!! Breadcrumbs::render('PageAbout') !!}
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <h1 class="headline">{{__('web/menu.main_about')}}</h1>
            </div>
            <div class="row PageView">
                {!! $page->des !!}
            </div>
        </div>
    </div>
@endsection
