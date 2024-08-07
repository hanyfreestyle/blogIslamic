@extends('web.layouts.app')
@section('content')
    <x-admin.hmtl.test-meta/>
    <div class="area_padding">
        <div class="container BlogList">
            <div class="row">
                <div class="col-lg-12">
                    {!! Breadcrumbs::render('TagView',$tag) !!}
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="section-headline text-center">
                        <h2 class="headline" >{{$tag->name}}</h2>
                    </div>

                </div>
            </div>
            <div class="row">
                @foreach($ReletedBlog as $blog)
                    <x-site.blog-card :row="$blog" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
