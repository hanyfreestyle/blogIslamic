<thead>
<tr>
    <th class="TD_20">#</th>


    @if($Config['postPhotoView'])
        <th class="TD_20"></th>
    @endif

    @if($Config['postPublishedDate'])
        <th class="TD_100">{{$Config['LangPostPublishedDateName']}}</th>
    @endif

    <th class="TD_250">{{$Config['LangPostDefName']}}</th>

    @if($pageData['ViewType'] == 'deleteList')
        <x-admin.table.soft-delete/>
    @else

        @if($Config['TableCategory'])
            <th class="TD_250">{{__('admin/blogPost.cat_text_name')}}</th>
        @endif

        <th class="TD_20"></th>
        <x-admin.table.action-but po="top" type="edit"/>
        <x-admin.table.action-but po="top" type="delete"/>
    @endif
</tr>
</thead>
