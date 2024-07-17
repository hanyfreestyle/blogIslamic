@extends('web.layouts.app')
@section('content')
    <div class="section-space pt-4 bg-primary-5p">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-lg-7 mt-5 ThanksPage">
                    <div class="text-center">
                        <h1 class="mt-4 mb-2 ">{{__('web/contact.thanks_h1')}}</h1>
                        <p class="mb-5">{!! nl2br(__('web/contact.thanks_p')) !!} </p>
                        <x-site.def.img type="DefPhotoList" :row="$DefPhotoList" def="thanks" def-name="photo" alt="404" class="img-fluid"  />
                    </div>
                </div>
                <div class="col-lg-4 mt-5">
                    <x-site.contact.page-but/>
                </div>
            </div>
        </div>
    </div>
@endsection
