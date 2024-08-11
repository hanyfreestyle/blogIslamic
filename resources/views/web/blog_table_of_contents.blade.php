<ul>
    @foreach($contents as $key => $header)
        @if(issetArr($header,'id'))
            <li><a href="#{{$header['id']}}-{{\App\Helpers\AdminHelper::Url_Slug(strip_tags($header['header']))}}">{!! strip_tags($header['header']) !!}</a></li>
        @endif
        @if (!empty($header['childs']))
            @include('web.blog_table_of_contents', ['contents' => $header['childs']])
        @endif
    @endforeach
</ul>
