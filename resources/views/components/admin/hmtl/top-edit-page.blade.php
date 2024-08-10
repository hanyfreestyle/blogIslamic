<x-admin.hmtl.section>
    @if($pageData['ViewType'] == 'Edit')
        <div class="row mb-2">
            <div class="col-6">
                <h1 class="def_h1_new">{!! print_h1($row) !!}</h1>
            </div>
            <div class="col-6 dir_button">
                @if(isset($pageData['AddLang']) and $pageData['AddLang'] == true )
                    <x-admin.lang.add-new-button :row="$row" :tip="false"/>
                    <x-admin.lang.delete-button :row="$row"/>
                @endif

                @if($row->is_active == 0)
                    <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.publishNow',$row->id)}}" :tip="false" type="confirmSweet"/>
                @endif


                @if($Config['TableMorePhotos'])
                    <x-admin.form.action-button url="{{route($PrefixRoute.'.More_Photos',$row->id)}}" type="morePhoto" :tip="false"/>
                @endif

                @can($PrefixRole.'_delete')
                    @if(Route::has($PrefixRoute.'.destroyEdit'))
                            <x-admin.form.action-button url="#" id="{{route($PrefixRoute.'.destroyEdit',$row->id)}}" :tip="false" type="deleteSweet"/>
                    @endif
                @endcan

                @if($webSlug != null)
                    <x-admin.form.action-button url="{{route($webSlug,$row->slug)}}" :print-lable="__('admin/def.blog_view')" bg="dark" icon="fa fa-eye" :tip="false"/>
                @endif
            </div>
        </div>
    @endif
</x-admin.hmtl.section>
