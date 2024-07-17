@if($rows instanceof \Illuminate\Pagination\AbstractPaginator)
    {{ $rows->links('web.layouts.inc.pagination') }}
@endif
