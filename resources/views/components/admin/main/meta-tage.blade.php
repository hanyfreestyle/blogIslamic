<div class="row">
    @foreach ( config('app.web_lang') as $key=>$lang )
        <div class="col-lg-{{getColLang(6)}}">
            <x-admin.form.trans-input :row="$oldData" name="g_title" :key="$key" :tdir="$key" :label="__('admin/form.text_g_title')"/>
            <x-admin.form.trans-text-area :row="$oldData" name="g_des" :key="$key" :tdir="$key" :label="__('admin/form.text_g_des')"/>
       </div>
    @endforeach
</div>
