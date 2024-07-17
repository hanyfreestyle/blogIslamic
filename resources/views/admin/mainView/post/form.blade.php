@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.top-edit-page :page-data="$pageData" :row="$rowData" web-slug="BlogView"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_type" value="{{$pageData['ViewType']}}">
                <input type="hidden" name="config" value="{{json_encode($Config)}}">

                <div class="row">
                    @if($Config['postPublishedDate'])
                        <x-admin.form.date-form name="published_at" value="{{old('published_at',$rowData->published_at)}}" col="2"/>
                    @endif

                    @if($Config['TableCategory'])
                        <x-admin.form.select-multiple name="categories" :categories="$Categories" :sel-cat="$selCat" col="7"/>
                    @endif

                    @if($Config['postAddBrand'] and File::isFile(base_path('routes/AppPlugin/proProduct.php')))
                        <x-admin.form.select-arr name="brand_id" sendvalue="{{old('brand_id',$rowData->brand_id)}}" :required-span="false"
                                                 :send-arr="$CashBrandList" label="{{__('admin/proProduct.app_menu_brand')}}" col="3"/>
                    @endif
                </div>
                @if($Config['TableTags'])
                    <div class="row">
                        <x-admin.form.select-multiple name="tag_id" :categories="$tags" :sel-cat="$selTags" col="12" :label="__('admin/blogPost.blog_text_tags')"/>
                    </div>
                @endif
                <div class="row">
                    <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
                    @foreach ( $LangAdd as $key=>$lang )
                        <x-admin.lang.meta-tage-seo :lang-add="$LangAdd" :viewtype="$pageData['ViewType']" :row="$rowData" :key="$key"
                                                    :full-row="$Config['postFullRow']" :slug="$Config['postSlug']" :seo="$Config['postSeo']"
                                                    :des="$Config['postDes']" :showlang="$Config['postShowLang']"
                                                    :def-name="$Config['LangPostDefName']" :def-des="$Config['LangPostDefDes']"/>
                    @endforeach
                </div>

                <hr>
                <x-admin.form.check-active name="is_active" :row="$rowData" :page-view="$pageData['ViewType']"/>

                @if($Config['postYoutube'])
                    <hr>
                    <div class="row">
                        <x-admin.form.input name="youtube" :row="$rowData" :label="__('admin/form.text_youtube')" col="4" tdir="en" :req="false"/>
                        @foreach ( $LangAdd as $key=>$lang )
                            <x-admin.form.trans-input name="youtube_title" :key="$key" :row="$rowData" :label="__('admin/form.text_youtube_title')" col="4" :req="false"
                                                      :tdir="$key"/>
                        @endforeach
                    </div>
                @endif

                <hr>
                @if($Config['postPhotoAdd'])
                    <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="6"/>
                @endif

                <x-admin.form.submit-role-back :page-data="$pageData"/>
            </form>
        </x-admin.card.def>
    </x-admin.hmtl.section>
@endsection


@push('JsCode')
    <x-admin.table.sweet-delete-js/>
    <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
    @if($Config['TableTags'] and $Config['TableTagsOnFly'] )
        <x-admin.ajax.tag-serach/>
    @endif
    @if($viewEditor and $Config['postEditor'])
        <script src="{{defAdminAssets('ckeditor/ckeditor.js')}}"></script>
        @foreach ( config('app.web_lang') as $key=>$lang )
            <x-admin.java.ckeditor4 name="{{$key}}[des]" id="{{$key}}_des" :dir="$key"/>
        @endforeach
    @endif
@endpush
