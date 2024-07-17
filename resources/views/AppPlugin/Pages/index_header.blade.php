<thead>
<tr>
  <th class="TD_20">#</th>
  <th class="TD_20"></th>

  @foreach(config('app.web_lang') as $key => $lang)
    <th>{{__('admin/pages.page_text_name')}}  {{printLableKey($key)}}</th>
  @endforeach

  @if($pageData['ViewType'] == 'deleteList')
    <x-admin.table.soft-delete/>
  @else
    <th class="TD_250">{{__('admin/pages.cat_text_name')}}</th>
    <th class="TD_20"></th>
    <x-admin.table.action-but po="top" type="edit"/>
    <x-admin.table.action-but po="top" type="addLang"/>
    <x-admin.table.action-but po="top" type="edit"/>
    <x-admin.table.action-but po="top" type="delete"/>
  @endif
</tr>
</thead>
