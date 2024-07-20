@extends('web.layouts.app')
@section('content')
    <div class="area_padding">


        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {{ Breadcrumbs::render('page404',$meta) }}
                </div>
            </div>
        </div>


        <div class="container mb__50">
            <div class="row justify-content-center">
                <div class="col-lg-5 order-2 mt-lg-5">
                    <h1 class="mt-10 mb-5 err404_h1 text-center"> {!! printLang(__('web/err404.h1')) !!} </h1>
                    <h2 class="err404_h2 mt-5 mb-5">{!! printLang(__('web/err404.h2')) !!}</h2>
                    <div class="row mb-10 err404_menu">

                        <div class="col-lg-3 col-6 mb-3 text-center">
                            <div class="menu">
                                <a href="{{route('PageAbout')}}">
                                    <i class="las la-pen-nib"></i>
                                    <p> {{__('web/menu.main_about')}}</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6 mb-3 text-center">
                            <div class="menu">
                                <a href="{{route('categories_list')}}">
                                    <i class="las la-rss"></i>
                                    <p>{{__('web/menu.main_category')}}</p>
                                </a>
                            </div>
                        </div>


                        <div class="col-lg-3 col-6 mb-3 text-center">
                            <div class="menu">
                                <a href="{{route('PageReview')}}">
                                    <i class="las la-gift"></i>
                                    <p> {{__('web/menu.main_review')}}</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6 mb-3 text-center">
                            <div class="menu">
                                <a href="{{route('PagePrivacy')}}">
                                    <i class="las la-phone-volume"></i>
                                    <p>{{__('web/menu.privacy')}}</p>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="text-center mt__20">
                        <a href="{{route('page_index')}}" class="btn">
                            <span class="d-inline-block"> {{__('web/err404.home_but')}} </span>
                        </a>
                    </div>
                </div>
                @if(isset($DefPhotoList))
                    <div class="col-lg-5 order-1 text-center">
                        <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="err_404" def-name="photo" alt="404" class="img-fluid"/>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
