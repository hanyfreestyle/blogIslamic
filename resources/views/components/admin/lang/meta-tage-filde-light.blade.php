<div class="row">
  <x-admin.form.trans-input name="name" :key="$key" :row="$row" :label="$defName" :tdir="$key"/>
  @if($des)
    <x-admin.form.trans-text-area name="des" :key="$key" :row="$row" :label="$defdes" :tdir="$key"/>
  @endif

  @if($seo)
    <x-admin.form.trans-input name="g_title" :key="$key" :row="$row" :label="__('admin/form.text_g_title')" :tdir="$key"/>

    <x-admin.form.trans-text-area name="g_des" :key="$key" :row="$row" :label="__('admin/form.text_g_des')" :tdir="$key"/>

    <x-admin.form.trans-input name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key"/>
  @endif

</div>

