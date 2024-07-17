@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        @if($pageData['ViewType'] == 'Edit')
            <div class="row mb-2">
                <div class="col-9">
                    <h1 class="def_h1_new">{!! print_h1($rowData) !!}</h1>
                </div>
                <div class="col-3 dir_button">
                    <x-admin.lang.delete-button :row="$rowData"/>
                </div>
            </div>
        @endif
    </x-admin.hmtl.section>


    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">
            <form class="mainForm" action="{{route($PrefixRoute.'.update',intval($rowData->id))}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="config" value="{{json_encode($Config)}}">
                <input type="hidden" name="add_lang" value="{{json_encode($LangAdd)}}">
                @csrf
                @if($Config['categoryTree'])
                    <div class="row">
                        <x-admin.form.select-category name="parent_id" label="{{__('admin/form.sel_categories')}}"
                                                      :sendvalue="old('parent_id',$rowData->parent_id)" :req="false" col="col-lg-6 "
                                                      :send-arr="$Categories"/>
                    </div>
                @endif

                <div class="row">

                    @foreach ( $LangAdd as $key=>$lang )
                        <x-admin.lang.meta-tage-seo :lang-add="$LangAdd" :viewtype="$pageData['ViewType']" :row="$rowData" :key="$key"
                                                    :full-row="$Config['categoryFullRow']" :slug="$Config['categorySlug']" :seo="$Config['categorySeo']"
                                                    :des="$Config['categoryDes']" :showlang="$Config['categoryShowLang']"
                                                    :def-name="$Config['LangCategoryDefName']" :def-des="$Config['LangCategoryDefDes']"/>
                    @endforeach
                </div>

                <hr>
                <div class="row">
                    <x-admin.form.check-active :row="$rowData" name="is_active" page-view="{{$pageData['ViewType']}}"
                                               :lable="__('admin/def.status_active')"/>

                </div>
                <hr>
                @if($Config['categoryPhotoAdd'])
                    <div class="row">
                        <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="6"/>
                        @if($Config['categoryIcon'])
                            <x-admin.form.upload-model-photo :page="$pageData" :row="$rowData" col="6" file-name="icon" db-name="icon"
                                                             filter-input-name="IconFilter" filter-name="_iconfilterid" route=".emptyIcon"/>
                        @endif

                    </div>
                @endif
                <x-admin.form.submit-role-back :page-data="$pageData"/>

            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>


@endsection


@push('JsCode')
    <x-admin.java.update-slug :view-type="$pageData['ViewType']"/>
    <x-admin.table.sweet-delete-js/>
    @if($viewEditor and $Config['categoryEditor'])
        <script src="{{defAdminAssets('ckeditor/ckeditor.js')}}"></script>
        @foreach ( config('app.web_lang') as $key=>$lang )
            <x-admin.java.ckeditor4 name="{{$key}}[des]" id="{{$key}}_des" :dir="$key"/>
        @endforeach
    @endif
@endpush
