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

                                <x-admin.form.select-arr name="web_status" :sendvalue="old('web_status',$setting->web_status)"
                                                         :label="__('admin/config/webConfig.status_web')" col="4" select-type="selActive"/>
                                <x-admin.form.select-arr name="switch_lang" :sendvalue="old('switch_lang',$setting->switch_lang)"
                                                         :label="__('admin/config/webConfig.web_switch_lang')" col="4"
                                                         select-type="selActive"/>
                                <x-admin.form.select-arr name="users_login" :sendvalue="old('users_login',$setting->users_login)"
                                                         :label="__('admin/config/webConfig.web_users_login')" col="4"
                                                         select-type="selActive"/>

                            </div>

                            <div class="row">


                                <x-admin.form.select-arr name="serach" :sendvalue="old('serach',$setting->serach)" :label="__('admin/config/webConfig.web_serach')"
                                                         col="4" select-type="selActive"/>
                                <x-admin.form.select-arr name="serach_type" :sendvalue="old('serach_type',$setting->serach_type)"
                                                         :label="__('admin/config/webConfig.web_serach_type')" col="4"
                                                         :send-arr="$WebSearchTypeArr"/>
                                <x-admin.form.select-arr name="wish_list" :sendvalue="old('wish_list',$setting->wish_list)"
                                                         :label="__('admin/config/webConfig.web_wish_list')" col="4"
                                                         select-type="selActive"/>

                            </div>


                            <div class="row">
                                @foreach ( config('app.web_lang') as $key=>$lang )

                                    <div class="col-lg-{{getColLang(6)}}">
                                        <x-admin.form.trans-input name="name" :row="$setting" :key="$key" :tdir="$key"
                                                                  :label="__('admin/config/webConfig.website_name')"/>
                                        <x-admin.form.trans-text-area name="closed_mass" :row="$setting" :key="$key" :tdir="$key"
                                                                      :label="__('admin/config/webConfig.closed_mass')"/>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="col-lg-5">
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

                @if(File::isFile(base_path('routes/AppPlugin/proProduct.php')))
                    <div class="col-lg-12">
                        <div class="row">
                            <x-admin.card.normal col="col-lg-6" title="{{__('admin/proProduct.web_setting_card')}}">
                                <div class="row">
                                    <x-admin.form.select-arr name="page_about" :sendvalue="old('page_about',$setting->page_about)"
                                                             :label="__('admin/proProduct.web_page_about')" col="4" :send-arr="$pagesList"/>
                                    <x-admin.form.select-arr name="page_warranty" :sendvalue="old('page_warranty',$setting->page_warranty)"
                                                             :label="__('admin/proProduct.web_page_warranty')" col="4" :send-arr="$pagesList"/>
                                    <x-admin.form.select-arr name="page_shipping" :sendvalue="old('page_shipping',$setting->page_shipping)"
                                                             :label="__('admin/proProduct.web_page_shipping')" col="4" :send-arr="$pagesList"/>
                                    <x-admin.form.select-arr name="pro_sale_lable" :sendvalue="old('pro_sale_lable',$setting->pro_sale_lable)"
                                                             :label="__('admin/proProduct.web_sale_lable')" col="4" select-type="selActive"/>
                                    <x-admin.form.select-arr name="pro_quick_view" :sendvalue="old('pro_quick_view',$setting->pro_quick_view)"
                                                             :label="__('admin/proProduct.web_quick_view')" col="4" select-type="selActive"/>
                                    <x-admin.form.select-arr name="pro_quick_shop" :sendvalue="old('pro_quick_shop',$setting->pro_quick_shop)"
                                                             :label="__('admin/proProduct.web_quick_shop')" col="4" select-type="selActive"/>
                                    <x-admin.form.select-arr name="pro_warranty_tab" :sendvalue="old('pro_warranty_tab',$setting->pro_warranty_tab)"
                                                             :label="__('admin/proProduct.web_warranty_tab')" col="4"
                                                             select-type="selActive"/>
                                    <x-admin.form.select-arr name="pro_shipping_tab" :sendvalue="old('pro_shipping_tab',$setting->pro_shipping_tab)"
                                                             :label="__('admin/proProduct.web_shipping_tab')" col="4"
                                                             select-type="selActive"/>
                                    <x-admin.form.select-arr name="pro_social_share" :sendvalue="old('pro_social_share',$setting->pro_social_share)"
                                                             :label="__('admin/proProduct.web_social_share')" col="4"
                                                             select-type="selActive"/>
                                </div>
                            </x-admin.card.normal>

                            <x-admin.card.normal col="col-lg-6" title="{{__('admin/proProduct.web_city_card')}}">
                                <div class="row">


                                    <x-admin.form.select-multiple name="pro_main_city_id" label="{{__('admin/form.sel_categories')}}"
                                                                  :categories="$cashCityList" :sel-cat="json_decode($setting->pro_main_city_id,true)"
                                                                  :req="false" col="12"
                                    />

                                    <x-admin.form.input :row="$setting" name="pro_main_city_discount" :label="__('admin/proProduct.web_city_main_discount')" col="6"
                                                        tdir="en"/>
                                    <x-admin.form.input :row="$setting" name="pro_main_city_rate" :label="__('admin/proProduct.web_city_main_rate')" col="6" tdir="en"/>
                                    <x-admin.form.input :row="$setting" name="pro_all_city_discount" :label="__('admin/proProduct.web_city_all_discount')" col="6" tdir="en"/>
                                    <x-admin.form.input :row="$setting" name="pro_all_city_rate" :label="__('admin/proProduct.web_city_all_rate')" col="6" tdir="en"/>

                                </div>
                            </x-admin.card.normal>
                        </div>
                    </div>
                @endif

                <div class="col-lg-12">
                    <div class="row">
                        <x-admin.card.normal col="col-lg-6" title="Telegram">
                            <div class="row">
                                <x-admin.form.select-arr name="telegram_send" :sendvalue="old('telegram_send',$setting->telegram_send)" label="Send" col="4"
                                                         select-type="selActive"/>
                                <x-admin.form.input :row="$setting" name="telegram_key" label="Telegram Key" col="12" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="telegram_phone" label="Telegram Group" col="12" tdir="en"/>
                                <x-admin.form.input :row="$setting" name="telegram_group" label="Telegram Phone" col="12" tdir="en"/>
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
