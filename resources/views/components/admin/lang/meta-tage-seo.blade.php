@if(count(config('app.web_lang')) > 1 and  $showlang == true)
    <div class="col-lg-12 mt-3">
        <div class="LangHeader">{{$keyLang}}</div>
    </div>
@endif
<div class="{{$desRow}}">
    <div class="row">
        <x-admin.form.trans-input name="name" :key="$key" :row="$row" :label="$defName" :tdir="$key"/>
        @if($des)
            <x-admin.form.trans-text-area name="des" :key="$key" :row="$row" :label="$defDes" :tdir="$key" add-class="bigTextArea"/>
        @endif
    </div>
</div>


<div class="{{$seoRow}}">
    <div class="row">
        @if($slug)
            @if($viewtype == 'Add' )
                <x-admin.form.trans-input name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key"/>
            @elseif($viewtype == 'Edit')
                @can($PrefixRole."_edit_slug")
                    <x-admin.form.trans-input name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key"/>
                @else
                    <input type="hidden" name="{{ $key }}[slug]" value="{{$row->translate($key)->slug}}">
                @endcan
            @endif
        @endif

        @if($seo)
            <x-admin.form.trans-input name="g_title" :key="$key" :row="$row" :label="__('admin/form.text_g_title')" :req="$seoReq" :tdir="$key"/>
            <x-admin.form.trans-text-area name="g_des" :key="$key" :row="$row" :label="__('admin/form.text_g_des')" :req="$seoReq" :tdir="$key"/>
        @endif
    </div>
</div>
