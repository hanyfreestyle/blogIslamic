@extends('web.layouts.app')
@section('content')
    <div class="section-space pt-4 bg-primary-5p">
        <div class="container">
            <div class="row justify-content-center ">

                <div class="col-lg-4 mt-5">
                    <x-site.contact.unit-card :row="$unit"/>
                </div>

                <div class="col-lg-7 mt-5 contactForm">
                    <x-site.contact.form :form-type="$formType" :row="$unit" />
                </div>
            </div>

        </div>
    </div>
@endsection
