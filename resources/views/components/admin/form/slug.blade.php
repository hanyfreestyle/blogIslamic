@if($viewtype == 'Add' )
    <x-admin.form.trans-input name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key"
                              :label-view="$labelView" />
@elseif($viewtype == 'Edit')
    @can($PrefixRole."_edit_slug")
        <x-admin.form.trans-input name="slug" :key="$key" :row="$row" :label="__('admin/form.text_g_slug')" :tdir="$key"
                                  :label-view="$labelView" />
    @else
        <input type="hidden" name="{{ $key }}[slug]" value="{{$row->translate($key)->slug}}">
    @endcan
@endif