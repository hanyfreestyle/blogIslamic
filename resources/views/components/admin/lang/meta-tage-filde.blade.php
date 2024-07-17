@if(count(config('app.web_lang')) > 1 and  $showlang == true)
    <div class="col-lg-12 mt-3">
        <div class="LangHeader">{{$keyLang}}</div>
    </div>
@endif

<div class="col-lg-12">
    <div class="row">
        <x-admin.form.trans-input name="name" :key="$key" :row="$row" :label="$defName" :tdir="$key"
                                  :label-view="$labelView" :holder="$holder"/>

        @if($des)
            <x-admin.form.trans-text-area name="des" :key="$key" :row="$row" :label="$defdes" :tdir="$key"
                                          add-class="bigTextArea" :label-view="$labelView" :holder="$holder"/>
        @endif


        @if($seo)
            <x-admin.form.trans-input name="g_title" :key="$key" :row="$row" :label="__('admin/form.text_g_title')" :tdir="$key"
                                      :label-view="$labelView" :holder="$holder"/>
            <x-admin.form.trans-text-area name="g_des" :key="$key" :row="$row" :label="__('admin/form.text_g_des')" :tdir="$key"
                                          :label-view="$labelView" :holder="$holder"/>
        @endif

        @if($slug)
            @if($viewtype == 'Add' )
                <x-admin.form.trans-input name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key"
                                          :label-view="$labelView" :holder="$holder"/>
            @elseif($viewtype == 'Edit')
                @can($PrefixRole."_edit_slug")
                    <x-admin.form.trans-input name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key"
                                              :label-view="$labelView" :holder="$holder"/>
                @else
                    <input type="hidden" name="{{ $key }}[slug]" value="{{$row->translate($key)->slug}}">
                @endcan
            @endif
        @endif
    </div>
</div>
