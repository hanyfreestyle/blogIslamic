@if($btype == 'Edit')
    <x-admin.form.action-button url='{{route($PrefixRoute.".edit",$row->id)}}' type='edit'/>
@elseif($btype == 'AddRelease')
    <x-admin.form.action-button url='{{route($PrefixRoute.".AddRelease",$row->id)}}' type='AddRelease'/>
@elseif($btype == 'ListRelease')
    <x-admin.form.action-button url='{{route($PrefixRoute.".ListRelease",$row->id)}}' type='ListRelease'/>
@elseif($btype == 'is_active_update')
    <x-admin.ajax.update-status-but :row="$row"/>
    {{--    <x-admin.form.action-button url='{{route($PrefixRoute.".edit",$row->id)}}' type='edit'/>--}}
@elseif($btype == 'MorePhoto')
    <x-admin.form.action-button url='{{route($PrefixRoute.".More_Photos",$row->id)}}' type='morePhoto'/>
@elseif($btype == 'Delete')
    <a href="#" id="{{route($PrefixRoute.'.destroy',$row->id)}}" onclick="sweet_dalete(this.id)" class="edit btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
@elseif($btype == 'addLang')
    @if(!isset($row->translate('ar')->name))
        <x-admin.form.action-button url="{{route($PrefixRoute.'.editAr',$row->id)}}" icon="fa-solid fa-globe" :tip="true"
                                    print-lable="{{__('admin.multiple_lang_menu_ar')}}"/>
    @elseif(!isset($row->translate('en')->name))
        <x-admin.form.action-button url="{{route($PrefixRoute.'.editEn',$row->id)}}" icon="fa-solid fa-globe" :tip="true"
                                    print-lable="{{__('admin.multiple_lang_menu_en')}}"/>
    @endif

@elseif($btype == 'CatName')
    @if($Config['TableCategory'])
        @foreach($row->categories as $Category )
            <a href="{{route($PrefixRoute.'.ListCategory',$Category->id)}}">
                <span class="cat_table_name">{{ print_h1($Category)}}</span>
            </a>
        @endforeach
    @endif
@elseif($btype == 'TagsName')
    @foreach($row->tags as $tag )
        <span class="cat_table_name">{{$tag->name}}</span>
    @endforeach
@elseif($btype == 'CatNameNoSlug')
    @if($Config['TableCategory'])
        @foreach($row->categories as $Category )
            <span class="cat_table_name">{{ print_h1($Category)}}</span>
        @endforeach
    @endif
@elseif($btype == 'Password')
    <x-admin.form.action-button url="{{route($PrefixRoute.'.Password',$row->id)}}" type="password"/>
@elseif($btype == 'ViewListing')
    <x-admin.form.action-button url="{{route('page_ListView',$row->slug)}}" bg="dark" icon="fa fa-eye" :target="true"/>
@elseif($btype == 'Restore')
    @can($PrefixRole.'_restore')
        <x-admin.form.action-button url="{{route($PrefixRoute.'.restore',$row->id)}}" type="restor" :tip="true"/>
    @endcan
@elseif($btype == 'ForceDelete')
    @can($PrefixRole.'_restore')
        <a href="#" id="{{route($PrefixRoute.'.force',$row->id)}}" onclick="sweet_dalete(this.id)" class="edit btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
    @endcan
@endif






