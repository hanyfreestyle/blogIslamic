@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>

    <x-admin.hmtl.top-edit-page :page-data="$pageData" :row="$rowData" web-slug="blog_view"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData" :full-error="false">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_type" value="{{$pageData['ViewType']}}">
                <input type="hidden" name="config" value="{{json_encode($Config)}}">

                <div class="row">
                    <x-admin.form.select-arr name="is_active" select-type="postPublish" :sendvalue="old('is_active',$selActive)" :label="__('admin/def.post_publish')"
                                             col="3"/>
                    <x-admin.form.date-form name="published_at" value="{{old('published_at',$rowData->published_at)}}" col="2"/>
                    <x-admin.form.select-multiple name="categories" :categories="$Categories" :sel-cat="$selCat" col="7"/>
                </div>
                <div class="row">
                    <x-admin.form.select-multiple name="tag_id" :categories="$tags" :sel-cat="$selTags" col="12" :label="__('admin/blogPost.blog_text_tags')"/>
                </div>

                <div class="row">
                    <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
                    @foreach ( $LangAdd as $key=>$lang )
                        <x-admin.lang.meta-tage-seo :lang-add="$LangAdd" :viewtype="$pageData['ViewType']" :row="$rowData" :key="$key"
                                                    :full-row="true" :slug="$Config['postSlug']" :seo="false"
                                                    :des="$Config['postDes']" :showlang="$Config['postShowLang']"
                                                    :def-name="$Config['LangPostDefName']" :def-des="$Config['LangPostDefDes']"/>
                    @endforeach
                </div>

                <hr>
                <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="6"/>

                <x-admin.form.submit-role-back :page-data="$pageData"/>
            </form>
        </x-admin.card.def>
    </x-admin.hmtl.section>

    @if($pageData['ViewType'] == 'Edit')
        <x-admin.hmtl.section>
            <x-admin.card.normal :title="__('admin/def.blog_review')">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th> {{$rowData->userName->name}}</th>
                        <th> {{$rowData->created_at}}</th>
                    </tr>
                    </thead>
                    @foreach($rowData->reviews as $review)
                        <tr>
                            <td>{{$review->userName->name}}</td>
                            <td>{{$review->updated_at }}</td>
                        </tr>
                    @endforeach
                </table>
            </x-admin.card.normal>
            <div class="row mb-5"></div>
        </x-admin.hmtl.section>
    @endif

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
            <x-admin.java.ckeditor4 name="{{$key}}[des]" id="{{$key}}_des" :dir="$key" height="900"/>
        @endforeach
    @endif
@endpush
