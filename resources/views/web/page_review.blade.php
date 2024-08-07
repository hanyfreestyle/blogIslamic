@extends('web.layouts.app')
@section('content')
    <x-admin.hmtl.test-meta/>
    <div class="area_padding">
        <div class="container">
            <div class="col-lg-12">
                {!! Breadcrumbs::render('PageReview') !!}
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <h1 class="headline">{{$page->name}}</h1>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-9 PageView">
                    {!! $page->des !!}
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-8 PageView mt-lg-3">
                    @foreach($page->more_photos as $photo)
                        <div class="row justify-content-md-center">
                            <div class="col-lg-5 order-lg-1 reviewPhoto">
                                <x-site.def.img :row="$photo" def="categories" class="blog_img rounded-3" w="400" h="240"/>
                            </div>
                            <div class="col-lg-7 order-lg-2">{!! $photo->des !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
