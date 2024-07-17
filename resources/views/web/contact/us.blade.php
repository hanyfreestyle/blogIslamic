@extends('web.layouts.app')
@section('content')
    <x-site.def.breadcrumbs>
        {!! Breadcrumbs::render('contact_us') !!}
    </x-site.def.breadcrumbs>

    <div class="section-space pt-1 bg-primary-5p">
        <div class="container contactPage">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xxl-6">
                    <div class="text-center">
                        <h1 class="mt-4 mb-2 ">{{__('web/contact.h1')}}</h1>
                        <p class="mb-5">{{__('web/contact.h1_p')}} </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-7 mt-5 contactForm">
                    <x-site.contact.form />
                </div>
                <div class="col-lg-4 mt-5">
                    <x-site.contact.page-but/>
                </div>
            </div>
        </div>
    </div>

@endsection
