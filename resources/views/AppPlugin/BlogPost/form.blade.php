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
                                                    :olddata="$oldData"
                                                    :def-name="$Config['LangPostDefName']" :def-des="$Config['LangPostDefDes']"/>
                    @endforeach
                </div>
                @if($wordCount)
                    <hr>
                    <div class="wordcount">{{__('admin/blogPost.form_word_count')}} <span>{{$wordCount}}</span> {{__('admin/blogPost.form_word')}}</div>
                @endif
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
                            <td>{{$review->userName->name}} </td>
                            <td>{{dateDiff($review->updated_at)}}</td>
                            <td><a href="{{route('admin.Blog.BlogPost.ListRevision',$review->id)}}">عرض</a> </td>
                        </tr>
                    @endforeach
                </table>
            </x-admin.card.normal>
            <div class="row mb-5"></div>
        </x-admin.hmtl.section>
    @endif

@endsection


@push('JsCode')
    <script>
        // window.onbeforeunload = function (e) {
        //     e = e || window.event;
        //
        //     // For IE and Firefox prior to version 4
        //     if (e) {
        //         e.returnValue = 'Any string';
        //     }
        //
        //     // For Safari
        //     return 'Any string';
        // };

        // function goodbye(e) {
        //     if(!e) e = window.event;
        //     //e.cancelBubble is supported by IE - this will kill the bubbling process.
        //     e.cancelBubble = true;
        //     e.returnValue = 'You sure you want to leave?'; //This is displayed on the dialog
        //
        //     //e.stopPropagation works in Firefox.
        //     if (e.stopPropagation) {
        //         e.stopPropagation();
        //         e.preventDefault();
        //     }
        // }
        // window.onbeforeunload=goodbye;

    </script>
    <x-admin.table.sweet-delete-js/>
    <x-admin.table.sweet-confirm-js s-text="{{__('admin/blogPost.but_published_sweet')}}" />

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
