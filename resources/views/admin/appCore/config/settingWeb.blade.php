@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>


    <form class="mainForm" action="{{route('admin.webConfigUpdate')}}" method="post">
        @csrf
        <x-admin.hmtl.section>
            <div class="row">


                <x-admin.card.normal col="col-lg-12" title="{{__('admin/config/webConfig.app_menu')}}">
                    <div class="row">
                        @if($errors->has([]))
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissible">
                                    {{__('admin/alertMass.form_has_error')}}
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-7">
                            <div class="row">
                                @foreach ( config('app.web_lang') as $key=>$lang )

                                    <div class="col-lg-{{getColLang(6)}}">
                                        <x-admin.form.trans-input name="name" :row="$setting" :key="$key" :tdir="$key"
                                                                  :label="__('admin/config/webConfig.website_name')"/>

                                        <x-admin.form.trans-text-area name="closed_mass" :row="$setting" :key="$key" :tdir="$key"
                                                                      :label="__('admin/config/webConfig.closed_mass')"/>

                                        <x-admin.form.trans-input name="meta_des" :row="$setting" :key="$key" :tdir="$key"
                                                                  :label="__('admin/config/webConfig.meta_des')"/>

                                        <x-admin.form.trans-input name="whatsapp_des" :row="$setting" :key="$key" :tdir="$key"
                                                                  :label="__('admin/config/webConfig.whatsapp_des')"/>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="col-lg-5">
                            <div class="row">

                                <x-admin.form.select-arr name="web_status" :sendvalue="old('web_status',$setting->web_status)"
                                                         :label="__('admin/config/webConfig.status_web')" col="6" select-type="selActive"/>

{{--                                <x-admin.form.select-arr name="switch_lang" :sendvalue="old('switch_lang',$setting->switch_lang)"--}}
{{--                                                         :label="__('admin/config/webConfig.web_switch_lang')" col="4"--}}
{{--                                                         select-type="selActive"/>--}}
{{--                                <x-admin.form.select-arr name="users_login" :sendvalue="old('users_login',$setting->users_login)"--}}
{{--                                                         :label="__('admin/config/webConfig.web_users_login')" col="4"--}}
{{--                                                         select-type="selActive"/>--}}

                            </div>

                            <div class="row">
                                <x-admin.form.input :row="$setting" name="phone_num" :label="__('admin/config/webConfig.phone')" col="6" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="phone_call" :label="__('admin/config/webConfig.phone_call')" col="6" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="whatsapp_num" :label="__('admin/config/webConfig.whatsapp')" col="6" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="whatsapp_send" :label="__('admin/config/webConfig.whatsapp_send')" col="6" tdir="en"/>
                            </div>

                            <div class="row">
                                <x-admin.form.input :row="$setting" name="email" :label="__('admin/config/webConfig.email')" col="12" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="def_url" :label="__('admin/config/webConfig.def_url')" col="12" tdir="en"/>
                            </div>

                        </div>

                    </div>
                </x-admin.card.normal>


                <div class="col-lg-12">
                    <div class="row">

                        <x-admin.card.normal col="col-lg-6" title="Schema">
                            <div class="row">
                                <x-admin.form.input :row="$setting" name="schema_type" label="Type" col="4" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="schema_lat" label="latitude" col="4" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="schema_long" label="longitude" col="4" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="schema_postal_code" label="postalCode" col="4" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="schema_country" label="addressCountry" col="4" tdir="en"/>
                            </div>
                            <div class="row">
                                @foreach ( config('app.web_lang') as $key=>$lang )
                                    <div class="col-lg-{{getColLang(6)}}">
                                        <x-admin.form.trans-input name="schema_address" :row="$setting" :key="$key" :tdir="$key" label="streetAddress"/>
                                        <x-admin.form.trans-input name="schema_city" :row="$setting" :key="$key" :tdir="$key" label="addressLocality"/>
                                    </div>
                                @endforeach
                            </div>
                        </x-admin.card.normal>

                        <x-admin.card.normal col="col-lg-6" title="{{__('admin/config/webConfig.social_media')}}">
                            <div class="row">
                                <x-admin.form.input :row="$setting" name="facebook" label="Facebook" col="12" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="youtube" label="Youtube" col="12" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="twitter" label="Twitter" col="12" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="instagram" label="Instagram" col="12" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="linkedin" label="Linkedin" col="12" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="google_api" label="Google Api" col="12" tdir="en"/>
                            </div>
                        </x-admin.card.normal>
                    </div>
                </div>


            </div>
            <div class="mb-5">
                <x-admin.form.submit text="Edit"/>
            </div>

        </x-admin.hmtl.section>
    </form>

@endsection
