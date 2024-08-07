@extends('web.layouts.app')
@section('content')
    <x-admin.hmtl.test-meta/>
    <div class="area_padding">
        <div class="container">
            <div class="col-lg-12">
                {!! Breadcrumbs::render('categories') !!}
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <h2 class="headline">{{__('web/menu.main_category')}}</h2>
            </div>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="single-blog">
                            <a href="{{route('CategoryView',$category->slug)}}">
                                <div class="category_img">
                                    <x-site.def.img :row="$category" def="categories" class="blog_img rounded-3" w="400" h="240" />
                                </div>
                            </a>

                            <div class="category_text text-center">
                                <h3><a href="{{route('CategoryView',$category->slug)}}" class="crop_line_1">{{$category->name}} <span class="number">({{$category->count}})</span></a></h3>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <x-site.def.pagination :rows="$categories"/>
    </div>
@endsection
