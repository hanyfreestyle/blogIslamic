@extends('web.layouts.app')
@section('content')
    <x-admin.hmtl.test-meta/>
    <div class="area_padding">
        @foreach($categories as $category)
            <div class="container BlogList">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <h2 class="headline">{{$category->name}}</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach($category->homeBlog as $blog)
                        <x-site.blog-card :row="$blog"/>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
